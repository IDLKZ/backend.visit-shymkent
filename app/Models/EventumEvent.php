<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $cron_id
 * @property string $last_updated
 * @property string $current_updated
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property Cron $cron
 */
class EventumEvent extends Model
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
    protected $fillable = ['cron_id', 'event_id' ,'last_updated', 'current_updated', 'status', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cron()
    {
        return $this->belongsTo('App\Models\Cron');
    }

    public function event()
    {
        return $this->belongsTo('App\Models\Event',"event_id","event_id");
    }
}
