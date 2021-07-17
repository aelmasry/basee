<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\API\CreateAuthorAPIRequest;
use App\Http\Requests\API\UpdateAuthorAPIRequest;
use App\Models\Author;
use App\Repositories\AuthorRepository;
use Illuminate\Http\Request;
use App\Http\Resources\AuthorResource;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use Response;

/**
 * Class AuthorController
 * @package App\Http\Controllers\API
 */

class AuthorController extends AppBaseController
{
    /** @var  AuthorRepository */
    private $authorRepository;

    public function __construct(AuthorRepository $authorRepo)
    {
        $this->authorRepository = $authorRepo;
    }

    /**
     * Display a listing of the Author.
     * GET|HEAD /authors
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->limit ? $request->limit : 20;
        $page = $request->page && $request->page > 0 ? $request->page : 1;
        $skip = ($page - 1) * $limit;
        $authors = $this->authorRepository->where('status', true)->paginate($limit)->skip($skip);

        return $this->sendResponse(
            AuthorResource::collection($authors),
            __('lang.retrieved', ['model' => __('models/authors.plural')])
        );
    }

    /**
     * Store a newly created Author in storage.
     * POST /authors
     *
     * @param CreateAuthorAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateAuthorAPIRequest $request)
    {
        $input = $request->all();

        $author = $this->authorRepository->create($input);

        return $this->sendResponse(
            new AuthorResource($author),
            __('messages.saved', ['model' => __('models/authors.singular')])
        );
    }

    /**
     * Display the specified Author.
     * GET|HEAD /authors/{id}
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        /** @var Author $author */
        $author = $this->authorRepository->find($id);

        if (empty($author)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/authors.singular')])
            );
        }

        return $this->sendResponse(
            new AuthorResource($author),
            __('messages.retrieved', ['model' => __('models/authors.singular')])
        );
    }

    /**
     * Update the specified Author in storage.
     * PUT/PATCH /authors/{id}
     *
     * @param  int $id
     * @param UpdateAuthorAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAuthorAPIRequest $request)
    {
        $input = $request->all();

        /** @var Author $author */
        $author = $this->authorRepository->find($id);

        if (empty($author)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/authors.singular')])
            );
        }

        $author = $this->authorRepository->update($input, $id);

        return $this->sendResponse(
            new AuthorResource($author),
            __('messages.updated', ['model' => __('models/authors.singular')])
        );
    }

    /**
     * Remove the specified Author from storage.
     * DELETE /authors/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Author $author */
        $author = $this->authorRepository->find($id);

        if (empty($author)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/authors.singular')])
            );
        }

        $author->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/authors.singular')])
        );
    }
}
