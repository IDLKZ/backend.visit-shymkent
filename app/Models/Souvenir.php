<?php

namespace App\Models;

use App\FileUpload;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $category_id
 * @property integer $shop_id
 * @property string $title_ru
 * @property string $title_kz
 * @property string $title_en
 * @property string $description_ru
 * @property string $description_kz
 * @property string $description_en
 * @property string $eventum
 * @property string $image
 * @property string $price
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property SouvenirCategory $souvenirCategory
 * @property Shop $shop
 * @property Gallery[] $galleries
 */
class Souvenir extends Model
{
    use \App\Language;
    use FileUpload;
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['category_id', 'shop_id', 'title_ru', 'title_kz', 'title_en', 'description_ru', 'description_kz', 'description_en', 'eventum', 'image', 'price', 'status', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function souvenirCategory()
    {
        return $this->belongsTo('App\Models\SouvenirCategory', 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shop()
    {
        return $this->belongsTo('App\Models\Shop');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }
}
