<?php

namespace App\Repositories;

use App\Models\Audio;

/**
 * Class AudioRepository
 * @package App\Repositories
 * @version July 11, 2021, 1:25 pm UTC
 *
 * @method Audio findWithoutFail($id, $columns = ['*'])
 * @method Audio find($id, $columns = ['*'])
 * @method Audio first($columns = ['*'])
*/
class AudioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'book_id',
        'type',
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Audio::class;
    }
}
