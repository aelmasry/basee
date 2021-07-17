<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\BookDataTable;
use App\Http\Requests;
use App\Http\Requests\BookRequest;
use App\Repositories\AuthorRepository;
use App\Repositories\BookRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\NarratorRepository;
use App\Repositories\UploadRepository;
use Flash;
use Response;

class BookController extends Controller
{
    /** @var  BookRepository */
    private $bookRepository;

    /** @var  AuthorRepository */
    private $authorRepository;

    /** @var  CategoryRepository */
    private $categoryRepository;

    /** @var  NarratorRepository */
    private $narratorRepository;

    /** @var $uploadRepository */
    private $uploadRepository;

    /** @var localName */
    private $localName;

    public function __construct(
        BookRepository $bookRepo,
        AuthorRepository $authorRepo,
        UploadRepository $uploadRepo,
        CategoryRepository $categoryRepo,
        NarratorRepository $narratorRepo
    )
    {
        $this->bookRepository = $bookRepo;
        $this->authorRepository = $authorRepo;
        $this->uploadRepository = $uploadRepo;
        $this->narratorRepository = $narratorRepo;
        $this->categoryRepository = $categoryRepo;

        $this->localName = 'name_' . app()->getLocale();
    }

    /**
     * Display a listing of the Book.
     *
     * @param BookDataTable $bookDataTable
     * @return Response
     */
    public function index(BookDataTable $bookDataTable)
    {
        return $bookDataTable->render('admin.books.index');
    }

    /**
     * Show the form for creating a new Book.
     *
     * @return Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->where('status', 1)->pluck($this->localName, 'id');
        $authors = $this->authorRepository->where('status', 1)->pluck($this->localName, 'id');
        $narrators = $this->narratorRepository->where('status', 1)->pluck($this->localName, 'id');

        return view('admin.books.create', compact(['categories', 'authors', 'narrators']));
    }

    /**
     * Store a newly created Book in storage.
     *
     * @param BookRequest $request
     *
     * @return Response
     */
    public function store(BookRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;

        try {
            $book = $this->bookRepository->create($input);
            if (isset($input['image']) && $input['image']) {
                $cacheUpload = $this->uploadRepository->getByUuid($input['image']);
                $mediaItem = $cacheUpload->getMedia('image')->first();
                $mediaItem->copy($book, 'book');
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.book')]));

        return redirect(route('admin.books.index'));
    }

    /**
     * Display the specified Book.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $book = $this->bookRepository->find($id);

        if (empty($book)) {
            Flash::error(__('lang.not_found', ['operator' => __('models/books.singular')]));

            return redirect(route('admin.books.index'));
        }

        return view('admin.books.show')->with('book', $book);
    }

    /**
     * Show the form for editing the specified Book.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $book = $this->bookRepository->find($id);
        $categories = $this->categoryRepository->where('status', 1)->pluck($this->localName, 'id');
        $authors = $this->authorRepository->where('status', 1)->pluck($this->localName, 'id');
        $narrators = $this->narratorRepository->where('status', 1)->pluck($this->localName, 'id');

        if (empty($book)) {
            Flash::error(__('lang.not_found', ['operator' => __('models/books.singular')]));

            return redirect(route('admin.books.index'));
        }

        return view('admin.books.edit')->with([
                'book' => $book,
                'categories' => $categories,
                'authors' => $authors,
                'narrators' => $narrators,
            ]);
    }

    /**
     * Update the specified Book in storage.
     *
     * @param  int              $id
     * @param BookRequest $request
     *
     * @return Response
     */
    public function update($id, BookRequest $request)
    {
        $book = $this->bookRepository->find($id);

        if (empty($book)) {
            Flash::error(__('lang.not_found', ['model' => __('models/books.singular')]));

            return redirect(route('admin.books.index'));
        }

        $input = $request->all();
        $input['user_id'] = auth()->user()->id;

        try {
            $book = $this->bookRepository->update($input, $id);
            if (isset($input['image']) && $input['image']) {
                $cacheUpload = $this->uploadRepository->getByUuid($input['image']);
                $mediaItem = $cacheUpload->getMedia('image')->first();
                $mediaItem->copy($book, 'book');
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully', ['operator' => __('lang.book')]));

        return redirect(route('admin.books.index'));
    }

    /**
     * Remove the specified Book from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $book = $this->bookRepository->find($id);

        if (empty($book)) {
            Flash::error(__('lang.not_found', ['model' => __('models/books.singular')]));

            return redirect(route('admin.books.index'));
        }

        $this->bookRepository->delete($id);

        Flash::success(__('lang.deleted', ['model' => __('models/books.singular')]));

        return redirect(route('admin.books.index'));
    }

    /**
     * Remove Media of Author
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $book = $this->bookRepository->findWithoutFail($input['id']);
        try {
            if ($book->hasMedia($input['collection'])) {
                $book->getFirstMedia($input['collection'])->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
