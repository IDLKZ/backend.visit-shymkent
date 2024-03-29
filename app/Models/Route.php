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

    public function reviews()
    {
        return $this->hasMany(Review::class, 'route_id');
    }

    public function savings()
    {
        return $this->hasMany(Saving::class, 'route_id');
    }

    public function routePlace()
    {
        return $this->hasMany(RoutePlace::class, 'route_id');
    }

    public function typesRoute()
    {
        return $this->hasManyThrough(
            TypeOfRoute::class,
            RouteAndType::class,
            "route_id",
            "id",
            "id",
            "type_id"
        );
    }

    public function organizators()
    {
        return $this->hasManyThrough(
            Organizator::class,
            RouteAndOrganizator::class,
            "route_id",
            "id",
            "id",
            "organizator_id"
        );
    }

    public function places()
    {
        return $this->hasManyThrough(
            Place::class,
            RoutePlace::class,
            "route_id",
            "id",
            "id",
            "place_id"
        );
    }


}
