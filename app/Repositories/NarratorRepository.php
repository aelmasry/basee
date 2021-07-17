<?php

namespace App\Repositories;

use App\Models\Narrator;

/**
 * Class NarratorRepository
 * @package App\Repositories
 * @version July 6, 2021, 8:40 pm UTC
 *
 * @method Narrator findWithoutFail($id, $columns = ['*'])
 * @method Narrator find($id, $columns = ['*'])
 * @method Narrator first($columns = ['*'])
*/
class NarratorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name_en',
        'name_ar',
        'brief_en',
        'brief_ar',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Narrator::class;
    }
}
