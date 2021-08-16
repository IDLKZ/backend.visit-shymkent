<?php

namespace App\Models;

use App\FileUpload;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $place_id
 * @property integer $event_id
 * @property integer $route_id
 * @property integer $blog_id
 * @property integer $news_id
 * @property integer $shop_id
 * @property integer $organizator_id
 * @property integer $souvenir_id
 * @property string $title
 * @property string $rating
 * @property string $created_at
 * @property string $updated_at
 * @property Blog $blog
 * @property Event $event
 * @property News $news
 * @property Organizator $organizator
 * @property Place $place
 * @property Route $route
 * @property Shop $shop
 * @property Souvenir $souvenir
 */
class Rating extends Model
{
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
    protected $fillable = ['place_id', 'event_id', 'route_id', 'blog_id', 'news_id', 'shop_id', 'organizator_id', 'souvenir_id', 'title', 'rating', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

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
    public function news()
    {
        return $this->belongsTo(News::class);
    }

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function souvenir()
    {
        return $this->belongsTo(Souvenir::class);
    }
}
