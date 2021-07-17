<?php

namespace App\Models;

use App\I18n\LocalizableModel;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Audio
 * @package App\Models
 * @version July 11, 2021, 1:26 pm UTC
 *
 * @property \App\Models\Book $book
 * @property integer $book_id
 * @property string $type
 * @property string $name
 */
class Audio extends LocalizableModel implements HasMedia
{
    use HasFactory;
    use HasMediaTrait {
        getFirstMediaUrl as protected getFirstMediaUrlTrait;
    }

    public $table = 'audios';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'book_id',
        'user_id',
        'type',
        'file',
        'name_en',
        'name_ar',
        'status',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'book_id' => 'integer',
        'user_id' => 'integer',
        'type' => 'string',
        'file' => 'string',
        'name' => 'string',
        'status' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'book_id' => 'required',
        'file' => 'required|string|max:255',
        'name_en' => 'required|string|max:255',
        'name_ar' => 'required|string|max:255',
    ];

    /**
     * New Attributes
     *
     * @var array
     */
    protected $appends = [];

    /**
     * Localized attributes.
     *
     * @var array
     */
    protected $localizable = [
        'name',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     **/
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     **/
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
