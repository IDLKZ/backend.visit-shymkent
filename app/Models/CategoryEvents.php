<?php

namespace App\Models;

use App\FileUpload;
use App\Searchable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $title_ru
 * @property string $title_kz
 * @property string $title_en
 * @property string $alias
 * @property string $image
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property CategoriesEvent[] $categoriesEvents
 */
class CategoryEvents extends Model
{

    use Sluggable;
    use FileUpload;
    use \App\Language;
    use Searchable;

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
    protected $table = 'categoryevents';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['title_ru', 'title_kz', 'title_en', 'alias', 'image', 'status', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categoriesEvents()
    {
        return $this->hasMany(CategoryEvent::class, 'category_id');
    }

    public function events(){
        return $this->belongsToMany(Event::class,"categories_events","category_id","event_id");
    }
}
