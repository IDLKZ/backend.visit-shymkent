<?php

namespace App\Models;

use App\FileUpload;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $place_id
 * @property integer $type_id
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
 * @property mixed $ratings
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property Place $place
 * @property EventType $eventType
 * @property CategoriesEvent[] $categoriesEvents
 * @property Gallery[] $galleries
 * @property Workday[] $workdays
 */
class Event extends Model
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
    protected $fillable = ['organizator_id','place_id', 'type_id', 'title_ru', 'title_kz', 'title_en', 'description_ru', 'description_kz', 'description_en', 'alias', 'eventum', 'phone', 'social_networks', 'sites', 'address', 'address_link', 'price', 'image', 'ratings', 'status', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function organizator()
    {
        return $this->belongsTo(Organizator::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function eventType()
    {
        return $this->belongsTo(EventType::class, 'type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categoriesEvents()
    {
        return $this->belongsToMany(CategoryEvents::class,"categories_events","event_id","category_id");
    }

    public function categoryEvent()
    {
        return $this->hasMany(CategoryEvent::class);
    }

    public function category()
    {
        return $this->belongsToMany(CategoryEvents::class,"categories_events","event_id","category_id");
    }

    public function savings()
    {
        return $this->hasMany(Saving::class, 'event_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'event_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, 'event_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function workdays()
    {
        return $this->hasMany(Workday::class);
    }




}
