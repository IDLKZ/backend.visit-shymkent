<?php

namespace App\Models;

use App\FileUpload;
use App\Searchable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $title_ru
 * @property string $title_kz
 * @property string $title_en
 * @property string $description_ru
 * @property string $description_kz
 * @property string $description_en
 * @property string $alias
 * @property string $eventum
 * @property mixed $phone
 * @property mixed $social_networks
 * @property mixed $sites
 * @property string $address
 * @property string $address_link
 * @property string $price
 * @property string $image
 * @property string $video_ru
 * @property string $video_kz
 * @property string $video_en
 * @property string $audio_ru
 * @property string $audio_kz
 * @property string $audio_en
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property CategoriesPlace[] $categoriesPlaces
 * @property Event[] $events
 * @property Gallery[] $galleries
 * @property Workday[] $workdays
 */
class Place extends Model
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

    protected $casts = [
        'phone' => 'object',
        'social_networks' => 'object',
        'sites' => 'object',
    ];
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['type_id','organizator_id', 'title_ru', 'title_kz', 'title_en', 'description_ru', 'description_kz', 'description_en', 'alias', 'eventum', 'phone', 'social_networks', 'sites', 'email', 'address', 'address_link', 'price', 'image', 'video_ru', 'video_kz', 'video_en', 'audio_ru', 'audio_kz', 'audio_en', 'status', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organizator()
    {
        return $this->belongsTo(Organizator::class,"organizator_id");
    }

    public function user(){
        return $this->hasManyThrough(
            User::class,
            Organizator::class,
            'user_id', // Foreign key on organizator table...
            'id', // Foreign key on user table...
            'organizator_id', // Local key on place table...
            'id' // Local key on organizator table...
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categoriesPlaces()
    {
        return $this->hasMany(CategoriesPlace::class, 'place_id');
    }

    public function category()
    {
        return $this->belongsToMany(CategoryPlace::class,"categories_places","place_id","category_id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'place_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function workdays()
    {
        return $this->hasMany(Workday::class, 'place_id');
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'place_id');
    }

    public function savings()
    {
        return $this->hasMany(Saving::class, 'place_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'place_id');
    }
    public function type()
    {
        return $this->belongsTo(PlaceType::class, 'type_id');
    }

    public function routePlace(){
        return $this->hasMany(RoutePlace::class, 'place_id');
    }

    public function placeEvent(){
        return $this->hasMany(PlaceEvent::class,'place_id');
    }

    public function routes()
    {
        return $this->hasManyThrough(
            Route::class,
            RoutePlace::class,
            "place_id",
            "id",
            "id",
            "route_id"
        );
    }

    public function events(){
        return $this->hasManyThrough(
            Event::class,
            PlaceEvent::class,
            "place_id",
            "id",
            "id",
            "event_id"
        );
    }

}
