<?php

namespace App\Models;

use App\FileUpload;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $route_id
 * @property integer $type_id
 * @property string $created_at
 * @property string $updated_at
 * @property Route $route
 * @property RouteType $routeType
 */
class RouteAndType extends Model
{
    use FileUpload;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'routes_types';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['route_id', 'type_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function routeType()
    {
        return $this->belongsTo(TypeOfRoute::class, 'type_id');
    }
}
