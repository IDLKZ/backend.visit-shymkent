<?php

namespace App\Models;

use App\FileUpload;
use App\Searchable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $title_ru
 * @property string $title_kz
 * @property string $title_en
 * @property string $created_at
 * @property string $updated_at
 * @property Place[] $places
 */
class PlaceType extends Model
{
    use \App\Language;
    use FileUpload;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'place_type';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['title_ru', 'title_kz', 'title_en', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function places()
    {
        return $this->hasMany(Place::class, 'type_id');
    }
}
