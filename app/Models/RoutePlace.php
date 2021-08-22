<?php

namespace App\Models;

use App\FileUpload;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $route_id
 * @property integer $place_id
 * @property int $number
 * @property string $created_at
 * @property string $updated_at
 * @property Place $place
 * @property Route $route
 */
class RoutePlace extends Model
{
    use FileUpload;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'route_place';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['route_id', 'place_id', 'number', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}
