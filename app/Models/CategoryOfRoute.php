<?php

namespace App\Models;

use App\FileUpload;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $title_ru
 * @property string $title_kz
 * @property string $title_en
 * @property string $image
 * @property string $alias
 * @property string $created_at
 * @property string $updated_at
 * @property Route[] $routes
 */
class CategoryOfRoute extends Model
{
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
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'route_categories';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['title_ru', 'title_kz', 'title_en', 'image', 'alias','status', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function routes()
    {
        return $this->hasMany(Route::class, 'category_id');
    }
}
