<?php

namespace App\Models;

use App\FileUpload;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $category_id
 * @property integer $author_id
 * @property string $title_ru
 * @property string $title_en
 * @property string $title_kz
 * @property string $description_ru
 * @property string $description_en
 * @property string $description_kz
 * @property string $alias
 * @property string $image
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Categorynews $categorynews
 * @property Gallery[] $galleries
 */
class News extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */

    use FileUpload;
    use \App\Language;
    use Sluggable;


    public function sluggable(): array
    {
        return [
            'alias' => [
                'source' => 'title_ru'
            ]
        ];
    }

    protected $casts = [
        'created_at' => 'datetime:d.m.Y'
    ];

    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['category_id', 'author_id', 'title_ru', 'title_en', 'title_kz', 'description_ru', 'description_en', 'description_kz', 'alias', 'image', 'status', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'author_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categorynews()
    {
        return $this->belongsTo(CategoryNews::class, 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function galleries()
    {
        return $this->hasMany('App\Models\Gallery');
    }
}
