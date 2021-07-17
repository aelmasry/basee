<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\AudioDataTable;
use App\Http\Requests\AudioRequest;
use App\Repositories\AudioRepository;
use App\Repositories\BookRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Response;

class AudioController extends Controller
{
    /** @var  AudioRepository */
    private $audioRepository;

    /** @var  BookRepository */
    private $bookRepository;

    /** @var localName */
    private $localName;

    public function __construct(AudioRepository $audioRepo, BookRepository $bookRepo)
    {
        $this->audioRepository = $audioRepo;
        $this->bookRepository = $bookRepo;
        $this->bookRepository = $bookRepo;

        $this->localName = 'name_' . app()->getLocale();
    }

    /**
     * Display a listing of the Audio.
     *
     * @param AudioDataTable $audioDataTable
     * @return Response
     */
    public function index(Request $request, AudioDataTable $audioDataTable)
    {
        if($request->get('bookId')) {
            return $audioDataTable->with('bookId', $request->bookId)->render('admin.audios.index');
        }else {
            return $audioDataTable->render('admin.audios.index');
        }
    }

    /**
     * Show the form for creating a new Audio.
     *
     * @return Response
     */
    public function create()
    {
        $books = $this->bookRepository->where('status', 1)->pluck($this->localName, 'id');

        return view('admin.audios.create', compact(['books']));
    }

    /**
     * Store a newly created Audio in storage.
     *
     * @param AudioRequest $request
     *
     * @return Response
     */
    public function store(AudioRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;

        try {
            if (isset($input['file']) && $input['file']) {
                $fileName = time() . '_' . $request->file->getClientOriginalName();
                $filePath = $request->file('file')->storeAs('audios/' . $input['book_id'], $fileName, 'public');

                $input['file'] = $fileName;
            }

            $audio = $this->audioRepository->create($input);
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.audio')]));

        return redirect(route('admin.audios.index'));
    }

    /**
     * Display the specified Audio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $audio = $this->audioRepository->find($id);

        if (empty($audio)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.audio')]));

            return redirect(route('admin.audios.index'));
        }

        return view('admin.audios.show')->with('audio', $audio);
    }

    /**
     * Show the form for editing the specified Audio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $audio = $this->audioRepository->find($id);
        $books = $this->bookRepository->where('status', 1)->pluck($this->localName, 'id');
        if (empty($audio)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.audio')]));

            return redirect(route('admin.audios.index'));
        }

        return view('admin.audios.edit')->with([
            'audio' =>  $audio,
            'books' =>  $books,
        ]);
    }

    /**
     * Update the specified Audio in storage.
     *
     * @param  int              $id
     * @param AudioRequest $request
     *
     * @return Response
     */
    public function update($id, AudioRequest $request)
    {
        $audio = $this->audioRepository->find($id);

        if (empty($audio)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.audio')]));

            return redirect(route('admin.audios.index'));
        }

        $input = $request->all();

        try {
            if (isset($input['file']) && $input['file']) {
                $fileName = time() . '_' . $request->file->getClientOriginalName();
                $filePath = $request->file('file')->storeAs('audios/' . $input['book_id'], $fileName, 'public');

                $input['file'] = $fileName;
            }
            $audio = $this->audioRepository->update($input, $id);
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully', ['operator' => __('lang.audio')]));

        return redirect(route('admin.audios.index'));
    }

    /**
     * Remove the specified Audio from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $audio = $this->audioRepository->find($id);

        if (empty($audio)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.audio')]));

            return redirect(route('admin.audios.index'));
        }

        $this->audioRepository->delete($id);

        $file = public_path('audios/' . $audio->book_id).'/'.$audio->file;
        if (!Storage::exists($file)) {
            Storage::delete($file);
        }

        Flash::success(__('lang.deleted_successfully', ['operator' => __('lang.audio')]));

        return redirect(route('admin.audios.index'));
    }

}
