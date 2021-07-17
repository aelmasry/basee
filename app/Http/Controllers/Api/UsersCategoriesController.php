<?php

namespace App\Http\Controllers\Api;

use App\Models\UsersCategories;
use App\Repositories\UsersCategoriesRepository;
use Illuminate\Http\Request;
use App\Http\Resources\UsersCategoriesResource;
use Response;

/**
 * Class UserInterestsController
 * @package App\Http\Controllers\Api
 */

class UsersCategoriesController extends AppBaseController
{
    /** @var  UserInterestsRepository */
    private $userCategoriesRepository;

    public function __construct(UsersCategoriesRepository $userCategoriesRepo)
    {
        $this->userCategoriesRepository = $userCategoriesRepo;
    }

    /**
     * Display a listing of the UserInterests.
     * GET|HEAD /userInterests
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $userCategories = $this->userCategoriesRepository->where('user_id', $this->getUserId())->get();

        if ($userCategories->count() == 0) {
            return $this->sendError(
                __('lang.no_data')
            );
        }

        return $this->sendResponse(
            UsersCategoriesResource::collection($userCategories),
            __('lang.retrieved', ['model' => __('models/userInterests.plural')])
        );
    }

    /**
     * Store a newly created UserInterests in storage.
     * POST /userInterests
     *
     * @param CreateUserInterestsAPIRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //check request is not empty
        $valid = validator($request->all(), [
            'category.*' => 'required|exists:categories,id',
        ]);

        if ($valid->fails()) {
            return $this->sendError($valid->errors()->first(), 406);
        }

        $input = $request->all();

        foreach($input['category'] as $category)
        {
            $data = [
                'category_id' => $category,
                'user_id' => $this->getUserId(),
            ];

            $this->userCategoriesRepository->updateOrCreate($data);
        }

        return response()->json([
            'success' => true,
            'message' => __('lang.saved_successfully', ['operator' => __('lang.category')]),
        ], 200);
    }

    /**
     * Remove the specified UserInterests from storage.
     * DELETE /userInterests/{category}
     *
     * @param  int $category
     *
     * @return Response
     */
    public function destroy($category)
    {
        /** @var UsersCategoriesResource $userCategories  deleteWhere */
        $userCategories = $this->userCategoriesRepository->deleteWhere([
            'category_id' => $category,
            'user_id' => $this->getUserId(),
        ]);

        return response()->json([
            'success' => true,
            'message' => __('lang.deleted_successfully', ['operator' => __('lang.category')]),
        ], 200);
    }
}
