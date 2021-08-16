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
 * @property string $description_ru
 * @property string $description_kz
 * @property string $description_en
 * @property string $image
 * @property string $alias
 * @property string $time
 * @property string $distance
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property Gallery[] $galleries
 * @property RoutePoint[] $routePoints
 */
class Route extends Model
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
    protected $fillable = ['category_id','title_ru', 'title_kz', 'title_en', 'description_ru', 'description_kz', 'description_en','address', 'address_link', 'image', 'eventum' ,'alias', 'time', 'distance', 'status', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function routePoints()
    {
        return $this->hasMany(RoutePoint::class);
    }
    public function category()
    {
        return $this->belongsTo(CategoryOfRoute::class, 'category_id');
    }

    public function types(){
        return $this->hasMany(RouteAndType::class,"route_id");
    }

    public function organizatorsRoute(){
        return $this->hasMany(RouteAndOrganizator::class,"route_id");
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'route_id');
    }


}
