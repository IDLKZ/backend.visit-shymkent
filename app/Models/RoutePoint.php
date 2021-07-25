<?php

namespace App\Models;

use App\FileUpload;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $route_id
 * @property string $title_ru
 * @property string $title_kz
 * @property string $title_en
 * @property string $description_ru
 * @property string $description_kz
 * @property string $description_en
 * @property string $image
 * @property string $alias
 * @property string $price
 * @property string $address
 * @property string $address_link
 * @property mixed $phone
 * @property mixed $social_networks
 * @property mixed $sites
 * @property int $number
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property Route $route
 * @property Gallery[] $galleries
 */
class RoutePoint extends Model
{
    use \App\Language;
    use FileUpload;
    use Sluggable;
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['route_id', 'title_ru', 'title_kz', 'title_en', 'description_ru', 'description_kz', 'description_en', 'image', 'alias', 'price', 'address', 'address_link', 'phone', 'social_networks', 'sites', 'number', 'status', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

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


    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'point_id');
    }
}
