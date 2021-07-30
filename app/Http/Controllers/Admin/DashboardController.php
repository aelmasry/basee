<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class DashboardController extends Controller
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        parent::__construct();
        $this->middleware(['auth']);
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard.index');
    }


    public function switchStatus(Request $request)
    {
        $inputs = $request->all();
        $modelName = "App\\Models\\" . $inputs['model'];
        $attributeName = $inputs['attributeName'];
        $modelName = app()->make($modelName);
        $model = $modelName::find($inputs['id']);

        if (empty($model)) {
            return response()->json([
                'success' => false,
                'message' => __('lang.not_found', ['operator' => __('lang.' . strtolower($inputs['model']))]),
            ]);
        }

        if ($model->$attributeName) {
            $model->$attributeName = 0;
        } else {
            $model->$attributeName = 1;
        }

        $model->save();

        return response()->json([
            'success' => true,
            'message' => __('lang.saved_successfully', ['operator' => __('lang.' . strtolower($inputs['model']))]),
        ]);
    }
}
