<?php

namespace App\Models;

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
class RoutesType extends Model
{
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
        return $this->belongsTo('App\Models\Route');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function routeType()
    {
        return $this->belongsTo('App\Models\RouteType', 'type_id');
    }
}
