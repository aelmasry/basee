<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class UsersSettings
 * @package App\Models
 * @version July 16, 2021, 9:33 pm UTC
 *
 * @property string $key
 * @property string $value
 */
class UsersSettings extends Model
{

    public $table = 'users_settings';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'user_id',
        'key',
        'value'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'key' => 'string',
        'value' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'key' => 'required|string|max:191',
        'value' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * New Attributes
     *
     * @var array
     */
    protected $appends = [];

}
