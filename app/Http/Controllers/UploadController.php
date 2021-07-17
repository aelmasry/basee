<?php

namespace App\Http\Controllers;

use App\Repositories\UploadRepository;
use Illuminate\Http\Request;
use Prettus\Validator\Exceptions\ValidatorException;

class UploadController extends Controller
{
    private $uploadRepository;

    /**
     * UploadController constructor.
     * @param UploadRepository $UploadRepository
     */
    public function __construct(UploadRepository $uploadRepository)
    {
        parent::__construct();
        $this->uploadRepository = $uploadRepository;
    }

    public function index()
    {
        return view('uploads.index');
    }

    /**
     * Get images paths
     * @param $id
     * @param $conversion
     * @param null $filename
     * @return mixed
     */
    public function storage($id, $conversion, $filename = null)
    {
        $array = explode('.', $conversion . $filename);
        $extension = strtolower(end($array));
        if (isset($filename)) {
            return response()->file(storage_path('app/public/' . $id . '/' . $conversion . '/' . $filename));
        } else {
            $filename = $conversion;
            return response()->file(storage_path('app/public/' . $id . '/' . $filename));
        }

    }

    public function all(Request $request, $collection = null)
    {
        $allMedias = $this->uploadRepository->allMedia($collection);
        return $allMedias->toJson();
    }


    public function collectionsNames(Request $request)
    {
        $allMedias = $this->uploadRepository->collectionsNames();
        return $this->sendResponse($allMedias, 'Get Collections Successfully');
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $input = $request->all();

        try {
            $upload = $this->uploadRepository->create($input);
            if(is_array($input['file'])) {
                foreach ($input['file'] as $file) {
                    $upload->addMedia($file)
                        ->withCustomProperties(['uuid' => $input['uuid']])
                        ->toMediaCollection($input['field']);
                }
            }else {
                $upload->addMedia($input['file'])
                    ->withCustomProperties(['uuid' => $input['uuid']])
                    ->toMediaCollection($input['field']);
            }

        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }
    }

    /**
     * clear cache from Upload table
     */
    public function clear(Request $request)
    {
        $input = $request->all();
        if ($input['uuid']) {
            $result = $this->uploadRepository->clear($input['uuid']);
            return $this->sendResponse($result, 'Media deleted successfully');
        }
        return $this->sendResponse(false, 'Error will delete media');

    }

    /**
     * clear all cache
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clearAll()
    {
        $this->uploadRepository->clearAll();
        return redirect()->back();
    }

    public function remove(Request $request)
    {
        $input = $request->all();
        $user = $this->userRepository->findWithoutFail($input['id']);
        try {
            if ($user->hasMedia($input['collection'])) {
                $user->getFirstMedia($input['collection'])->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
