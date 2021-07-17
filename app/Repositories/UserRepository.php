<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;
/**
 * Class UserRepository
 * @package App\Repositories
 * @version July 10, 2018, 11:44 am UTC
 *
 * @method User findWithoutFail($id, $columns = ['*'])
 * @method User find($id, $columns = ['*'])
 * @method User first($columns = ['*'])
*/
class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'name',
        'email',
        'password',
        'api_token',
        'store_id',
        'role_id',
        'remember_token'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }

    public function getUserCompanyBySlug($name)
    {
        return $this->model->select('users.id', 'name', 'email', 'user_id')
                        ->join('companies', 'companies.user_id', 'users.id')
                        ->whereRaw('companies.slug="'.$name.'"')
                        ->get()
                        ->first();

    }
}
