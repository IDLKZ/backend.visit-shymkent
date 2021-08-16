<?php

namespace App\Models;

use App\FileUpload;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $route_id
 * @property integer $organizator_id
 * @property string $created_at
 * @property string $updated_at
 * @property Organizator $organizator
 * @property Route $route
 */
class RouteAndOrganizator extends Model
{
    use FileUpload;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'routes_organizators';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['route_id', 'organizator_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organizator()
    {
        return $this->belongsTo(Organizator::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}
