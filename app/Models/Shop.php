<?php

namespace App\Models;

use App\FileUpload;
use App\Role;
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
 * @property string $alias
 * @property string $image
 * @property string $eventum
 * @property mixed $phone
 * @property mixed $social_networks
 * @property mixed $sites
 * @property string $address
 * @property string $address_link
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property Role $role
 * @property User $user
 * @property Gallery[] $galleries
 * @property ShopUser[] $shopUsers
 * @property Souvenir[] $souvenirs
 */
class Shop extends Model
{

    use Sluggable;
    use \App\Language;
    use FileUpload;

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
    protected $casts = [
    'phone' => 'object',
    'social_networks' => 'object',
    'sites' => 'object',
];
    protected $fillable = ['user_id', 'role_id', 'title_ru', 'title_kz', 'title_en', 'description_ru', 'description_kz', 'description_en', 'alias', 'image', 'eventum', 'phone', 'social_networks', 'sites', 'address', 'address_link', 'status', 'created_at', 'updated_at'];

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shopUsers()
    {
        return $this->hasMany('App\Models\ShopUser');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function souvenirs()
    {
        return $this->hasMany(Souvenir::class);
    }
}
