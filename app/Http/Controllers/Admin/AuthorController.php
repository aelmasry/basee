<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AuthorDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\AuthorRequest;
use App\Repositories\AuthorRepository;
use App\Repositories\UploadRepository;
use Flash;
use Illuminate\Http\Request;
use Response;

class AuthorController extends Controller
{
    /** @var  AuthorRepository */
    private $authorRepository;

    /** @var $uploadRepository */
    private $uploadRepository;

    public function __construct(AuthorRepository $authorRepo, UploadRepository $uploadRepo)
    {
        $this->authorRepository = $authorRepo;
        $this->uploadRepository = $uploadRepo;
    }

    /**
     * Display a listing of the Author.
     *
     * @param AuthorDataTable $authorDataTable
     * @return Response
     */
    public function index(AuthorDataTable $authorDataTable)
    {
        return $authorDataTable->render('admin.authors.index');
    }

    /**
     * Show the form for creating a new Author.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.authors.create');
    }

    /**
     * Store a newly created Author in storage.
     *
     * @param AuthorRequest $request
     *
     * @return Response
     */
    public function store(AuthorRequest $request)
    {
        $input = $request->all();

        try {
            $author = $this->authorRepository->create($input);
            if (isset($input['image']) && $input['image']) {
                $cacheUpload = $this->uploadRepository->getByUuid($input['image']);
                $mediaItem = $cacheUpload->getMedia('image')->first();
                $mediaItem->copy($author, 'image');
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.author')]));

        return redirect(route('admin.authors.index'));
    }

    /**
     * Display the specified Author.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $author = $this->authorRepository->find($id);

        if (empty($author)) {
            Flash::error('Author not found');

            return redirect(route('admin.authors.index'));
        }

        return view('admin.authors.show')->with('author', $author);
    }

    /**
     * Show the form for editing the specified Author.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $author = $this->authorRepository->find($id);

        if (empty($author)) {
            Flash::error('Author not found');

            return redirect(route('admin.authors.index'));
        }

        return view('admin.authors.edit')->with('author', $author);
    }

    /**
     * Update the specified Author in storage.
     *
     * @param  int              $id
     * @param AuthorRequest $request
     *
     * @return Response
     */
    public function update($id, AuthorRequest $request)
    {
        $author = $this->authorRepository->find($id);

        if (empty($author)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.author')]));

            return redirect(route('admin.authors.index'));
        }

        $input = $request->all();
        try {
            $author = $this->authorRepository->update($input, $id);

            if (isset($input['image']) && $input['image']) {
                $cacheUpload = $this->uploadRepository->getByUuid($input['image']);
                $mediaItem = $cacheUpload->getMedia('image')->first();
                $mediaItem->copy($author, 'image');
                // $mediaItem->delete();
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully', ['operator' => __('lang.author')]));

        return redirect(route('admin.authors.index'));
    }

    /**
     * Remove the specified Author from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $author = $this->authorRepository->find($id);

        if (empty($author)) {
            Flash::error('Author not found');

            return redirect(route('admin.authors.index'));
        }

        $this->authorRepository->delete($id);

        Flash::success('Author deleted successfully.');

        return redirect(route('admin.authors.index'));
    }

    /**
     * Remove Media of Author
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $author = $this->authorRepository->findWithoutFail($input['id']);
        try {
            if ($author->hasMedia($input['collection'])) {
                $author->getFirstMedia($input['collection'])->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
