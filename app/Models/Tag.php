<?php

namespace App\Models;

use App\FileUpload;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $title_ru
 * @property string $title_en
 * @property string $title_kz
 * @property string $alias
 * @property string $image
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property Blog[] $blogs
 */
class Tag extends Model
{

    use Sluggable;
    use FileUpload;
    use \App\Language;

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
    protected $fillable = ['title_ru', 'title_en', 'title_kz', 'alias', 'image', 'status', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blogs()
    {
        return $this->hasMany('App\Models\Blog');
    }
}
