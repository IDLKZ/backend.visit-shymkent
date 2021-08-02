<?php

namespace App\Models;

use App\FileUpload;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $tag_id
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
 * @property Tag $tag
 * @property Gallery[] $galleries
 */
class Blog extends Model
{

    use FileUpload;
    use \App\Language;
    use Sluggable;

    protected $casts = [
        'created_at' => 'datetime:d-m-Y'
    ];

    public function sluggable(): array
    {
        return [
            'alias' => [
                'source' => 'title_ru'
            ]
        ];
    }
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['tag_id', 'author_id', 'title_ru', 'title_en', 'title_kz', 'description_ru', 'description_en', 'description_kz', 'alias', 'image', 'status', 'created_at', 'updated_at'];

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
    public function tag()
    {
        return $this->belongsTo('App\Models\Tag');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function galleries()
    {
        return $this->hasMany('App\Models\Gallery');
    }
}
