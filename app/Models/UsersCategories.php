<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class UsersCategories
 * @package App\Models
 * @version July 13, 2021, 9:01 pm UTC
 *
 * @property \App\Models\Category $category
 * @property \App\Models\User $user
 * @property integer $user_id
 * @property integer $category_id
 */
class UsersCategories extends Model
{

    public $table = 'users_categories';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'user_id',
        'category_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'category_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'category_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * New Attributes
     *
     * @var array
     */
    protected $appends = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(Category::class, 'user_id');
    }
}
