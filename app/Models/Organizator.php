<?php

namespace App\Models;

use App\FileUpload;
use App\Role;
use App\Searchable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $role_id
 * @property string $title_ru
 * @property string $title_kz
 * @property string $title_en
 * @property string $description_ru
 * @property string $description_kz
 * @property string $description_en
 * @property string $education_ru
 * @property string $education_kz
 * @property string $education_en
 * @property string $languages
 * @property string $image
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property Role $role
 * @property User $user
 * @property Gallery[] $galleries
 */
class Organizator extends Model
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
      "languages"=>"object",
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
    protected $fillable = ['user_id', 'role_id', 'title_ru', 'title_kz', 'title_en', 'description_ru', 'description_kz', 'description_en', 'alias', 'education_ru', 'education_kz', 'education_en', 'languages','phone','address', 'social_networks', 'sites', 'image','eventum','status', 'created_at', 'updated_at'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function places()
    {
        return $this->hasMany(Place::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function savings()
    {
        return $this->hasMany(Saving::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function routes()
    {
        return $this->hasManyThrough(
            Route::class,
            RouteAndOrganizator::class,
            "organizator_id",
            "id",
            "id",
            "route_id"
        );
    }







}
