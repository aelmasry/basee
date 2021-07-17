<?php

namespace App\Repositories;

use App\Models\UsersCategories;

/**
 * Class UsersCategoriesRepository
 * @package App\Repositories
 * @version July 13, 2021, 10:07 pm UTC
 *
 * @method UsersCategories findWithoutFail($id, $columns = ['*'])
 * @method UsersCategories find($id, $columns = ['*'])
 * @method UsersCategories first($columns = ['*'])
*/
class UsersCategoriesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'category_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UsersCategories::class;
    }
}
