<?php

namespace App\Repositories;

use App\Models\Book;

/**
 * Class BookRepository
 * @package App\Repositories
 * @version July 10, 2021, 8:19 pm UTC
 *
 * @method Book findWithoutFail($id, $columns = ['*'])
 * @method Book find($id, $columns = ['*'])
 * @method Book first($columns = ['*'])
*/
class BookRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name_en',
        'brief_en',
        'name_ar',
        'brief_ar',
        'type',
        'duration',
        'author_id',
        'narrator_id',
        'category_id',
        'user_id',
        'status',
        'free',
        'demo'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Book::class;
    }
}
