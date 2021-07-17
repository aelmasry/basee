<?php

namespace App\Models;

use App\I18n\LocalizableModel;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Book
 * @package App\Models
 * @version July 10, 2021, 8:17 pm UTC
 *
 * @property \App\Models\Author $author
 * @property \App\Models\Category $category
 * @property \App\Models\Narrator $narrator
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $audio
 * @property string $name_en
 * @property string $brief_en
 * @property string $name_ar
 * @property string $brief_ar
 * @property string $type
 * @property integer $duration
 * @property integer $author_id
 * @property integer $narrator_id
 * @property integer $category_id
 * @property integer $user_id
 * @property boolean $status
 * @property boolean $free
 * @property boolean $demo
 */
class Book extends LocalizableModel implements HasMedia
{
    use HasFactory;
    use HasMediaTrait {
        getFirstMediaUrl as protected getFirstMediaUrlTrait;
    }

    public $table = 'books';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name_en' => 'string',
        'brief_en' => 'string',
        'name_ar' => 'string',
        'brief_ar' => 'string',
        'type' => 'string',
        'duration' => 'integer',
        'author_id' => 'integer',
        'narrator_id' => 'integer',
        'category_id' => 'integer',
        'user_id' => 'integer',
        'status' => 'boolean',
        'free' => 'boolean',
        'demo' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name_en' => 'required|string|max:255',
        'brief_en' => 'required|string',
        'name_ar' => 'required|string|max:255',
        'brief_ar' => 'required|string',
        'type' => 'required|string',
        'duration' => 'required|integer',
        'author_id' => 'required',
        'narrator_id' => 'required',
        'category_id' => 'required',
        'user_id' => 'required',
        'status' => 'required|boolean',
        'free' => 'required|boolean',
        'demo' => 'required|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * New Attributes
     *
     * @var array
     */
    protected $appends = [
        'has_media',
        'sample',
        'summary',
        'podcast',
        'chapters'
    ];

    /**
     * Localized attributes.
     *
     * @var array
     */
    protected $localizable = [
        'name',
        'brief',
    ];

    /**
     * @param Media|null $media
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
        ->fit(Manipulations::FIT_CROP, 200, 200)
            ->sharpen(10);

        $this->addMediaConversion('icon')
        ->fit(Manipulations::FIT_CROP, 100, 100)
            ->sharpen(10);
    }

    /**
     * to generate media url in case of fallback will
     * return the file type icon
     * @param string $conversion
     * @return string url
     */
    public function getFirstMediaUrl($collectionName = 'default', $conversion = '')
    {
        $url = $this->getFirstMediaUrlTrait($collectionName);
        $array = explode('.', $url);
        $extension = strtolower(end($array));

        if (in_array($extension, config('medialibrary.extensions_has_thumb'))) {
            return asset($this->getFirstMediaUrlTrait($collectionName, $conversion));
        } else {
            return asset(config('medialibrary.icons_folder') . '/' . $extension . '.png');
        }
    }

    /**
     * Add Media to api results
     * @return bool
     */
    public function getHasMediaAttribute()
    {
        return $this->hasMedia('image') ? true : false;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function narrator()
    {
        return $this->belongsTo(Narrator::class, 'narrator_id');
    }

    public function audios()
    {
        return $this->belongsTo(Audio::class, 'book_id');
    }

    public function getSampleAttribute()
    {
        return Audio::where('status', 1)->where('book_id', $this->id)->where('type', 'sample')->get()->first();
    }

    public function getSummaryAttribute()
    {
        if($this->type == 'summary') {
            return Audio::where('status', 1)->where('book_id', $this->id)->where('type', 'summary')->get()->first();
        }else {
            return false;
        }
    }

    public function getPodcastAttribute()
    {
        if ($this->type == 'podcast') {
            return Audio::where('status', 1)->where('book_id', $this->id)->where('type', 'podcast')->get()->first();
        }else {
            return false;
        }
    }


    public function getChaptersAttribute()
    {
        if ($this->type == 'book') {
            return Audio::where('status', 1)->where('book_id', $this->id)->where('type', 'chapter')->get()->all();
        }else {
            return false;
        }
    }
}
