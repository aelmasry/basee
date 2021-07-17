<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\NarratorDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\NarratorRequest;
use App\Repositories\NarratorRepository;
use App\Repositories\UploadRepository;
use Flash;
use Illuminate\Http\Request;
use Response;

class NarratorController extends Controller
{
    /** @var  narratorRepository */
    private $narratorRepository;

    /** @var $uploadRepository */
    private $uploadRepository;

    public function __construct(NarratorRepository $narratorRepo, UploadRepository $uploadRepo)
    {
        $this->narratorRepository = $narratorRepo;
        $this->uploadRepository = $uploadRepo;
    }

    /**
     * Display a listing of the Narrator.
     *
     * @param NarratorDataTable $narratorDataTable
     * @return Response
     */
    public function index(NarratorDataTable $narratorDataTable)
    {
        return $narratorDataTable->render('admin.narrators.index');
    }

    /**
     * Show the form for creating a new Narrator.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.narrators.create');
    }

    /**
     * Store a newly created Narrator in storage.
     *
     * @param NarratorRequest $request
     *
     * @return Response
     */
    public function store(NarratorRequest $request)
    {
        $input = $request->all();

        try {
            $narrator = $this->narratorRepository->create($input);
            if (isset($input['image']) && $input['image']) {
                $cacheUpload = $this->uploadRepository->getByUuid($input['image']);
                $mediaItem = $cacheUpload->getMedia('image')->first();
                $mediaItem->copy($narrator, 'narrator');
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.narrator')]));

        return redirect(route('admin.narrators.index'));
    }

    /**
     * Display the specified Narrator.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $narrator = $this->narratorRepository->find($id);

        if (empty($narrator)) {
            Flash::error();

            return redirect(route('admin.narrators.index'));
        }

        return view('admin.narrators.show')->with('narrator', $narrator);
    }

    /**
     * Show the form for editing the specified Narrator.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $narrator = $this->narratorRepository->find($id);

        if (empty($narrator)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.narrator')]));

            return redirect(route('admin.narrators.index'));
        }

        return view('admin.narrators.edit')->with('narrator', $narrator);
    }

    /**
     * Update the specified Narrator in storage.
     *
     * @param  int              $id
     * @param NarratorRequest $request
     *
     * @return Response
     */
    public function update($id, NarratorRequest $request)
    {
        $narrator = $this->narratorRepository->find($id);

        if (empty($narrator)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.narrator')]));

            return redirect(route('admin.narrators.index'));
        }

        $input = $request->all();
        try {
            $narrator = $this->narratorRepository->update($input, $id);

            if (isset($input['image']) && $input['image']) {
                $cacheUpload = $this->uploadRepository->getByUuid($input['image']);
                $mediaItem = $cacheUpload->getMedia('image')->first();
                $mediaItem->copy($narrator, 'narrator');
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully', ['operator' => __('lang.narrator')]));

        return redirect(route('admin.narrators.index'));
    }

    /**
     * Remove the specified Narrator from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $narrator = $this->narratorRepository->find($id);

        if (empty($narrator)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.narrator')]));

            return redirect(route('admin.narrators.index'));
        }

        $this->narratorRepository->delete($id);

        Flash::success(__('lang.deleted_successfully', ['operator' => __('lang.narrator')]));

        return redirect(route('admin.narrators.index'));
    }

    /**
     * Remove Media of Narrator
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $narrator = $this->narratorRepository->findWithoutFail($input['id']);
        try {
            if ($narrator->hasMedia($input['collection'])) {
                $narrator->getFirstMedia($input['collection'])->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
