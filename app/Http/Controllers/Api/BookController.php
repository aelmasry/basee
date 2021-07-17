<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Repositories\BookRepository;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;
use Response;

/**
 * Class BookController
 * @package App\Http\Controllers\Api
 */

class BookController extends AppBaseController
{
    /** @var  BookRepository */
    private $bookRepository;

    public function __construct(BookRepository $bookRepo)
    {
        $this->bookRepository = $bookRepo;
    }

    /**
     * Display a listing of the Book.
     * GET|HEAD /books
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->limit ? $request->limit : 20;
        $page = $request->page && $request->page > 0 ? $request->page : 1;
        $skip = ($page - 1) * $limit;
        $books = $this->bookRepository->where('status', true)->paginate($limit)->skip($skip);

        return $this->sendResponse(
            BookResource::collection($books),
            __('lang.retrieved', ['model' => __('models/books.plural')])
        );
    }

    /**
     * Display the specified Book.
     * GET|HEAD /books/{id}
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        /** @var Book $book */
        $book = $this->bookRepository->find($id);

        if (empty($book)) {
            return $this->sendError(
                __('lang.not_found', ['model' => __('models/books.singular')])
            );
        }

        return $this->sendResponse(
            new BookResource($book),
            __('lang.retrieved', ['model' => __('models/books.singular')])
        );
    }
}
