<?php

namespace App\Models;

use App\FileUpload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $weekday_id
 * @property integer $place_id
 * @property integer $event_id
 * @property string $date_start
 * @property string $date_end
 * @property string $time_start
 * @property string $time_end
 * @property string $created_at
 * @property string $updated_at
 * @property Event $event
 * @property Place $place
 * @property Weekday $weekday
 */
class Workday extends Model
{
    use FileUpload;
    use \App\Language;
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['weekday_id', 'place_id', 'event_id','shop_id','point_id', 'date_start', 'date_end', 'time_start', 'time_end', 'created_at', 'updated_at'];






    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function weekday()
    {
        return $this->belongsTo(Weekday::class);
    }
}
