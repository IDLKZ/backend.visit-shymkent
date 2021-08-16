<?php

namespace App\Models;

use App\FileUpload;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $category_id
 * @property integer $place_id
 * @property string $created_at
 * @property string $updated_at
 * @property Categoryplace $categoryplace
 * @property Place $place
 */
class CategoriesPlace extends Model
{
    use FileUpload;
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    protected $table = 'categories_places';
    /**
     * @var array
     */
    protected $fillable = ['category_id', 'place_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoryplace()
    {
        return $this->belongsTo(CategoryPlace::class, 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function place()
    {
        return $this->belongsTo(Place::class,"place_id");
    }
}
