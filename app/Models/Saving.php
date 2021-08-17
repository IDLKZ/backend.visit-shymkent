<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $place_id
 * @property integer $event_id
 * @property integer $route_id
 * @property integer $blog_id
 * @property integer $news_id
 * @property integer $shop_id
 * @property integer $organizator_id
 * @property integer $souvenir_id
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
 * @property User $user
 */
class Saving extends Model
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
    protected $fillable = ['user_id', 'place_id', 'event_id', 'route_id', 'blog_id', 'news_id', 'shop_id', 'organizator_id', 'souvenir_id', 'created_at', 'updated_at'];

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function addSave($request)
    {
        $color = '';
        if (array_key_exists('place_id', $request)){
            $save = self::where(['user_id' => $request['user_id'], 'place_id' => $request['place_id']])->first();
            if ($save){
                $save->delete();
            } else {
                self::create($request);
                $color = 'color--red';
            }
        }
        if (array_key_exists('event_id', $request)){
            $save = self::where(['user_id' => $request['user_id'], 'event_id' => $request['event_id']])->first();
            if ($save){
                $save->delete();
            } else {
                self::create($request);
                $color = 'color--red';
            }
        }
        if (array_key_exists('route_id', $request)){
            $save = self::where(['user_id' => $request['user_id'], 'route_id' => $request['route_id']])->first();
            if ($save){
                $save->delete();
            } else {
                self::create($request);
                $color = 'color--red';
            }
        }
        if (array_key_exists('blog_id', $request)){
            $save = self::where(['user_id' => $request['user_id'], 'blog_id' => $request['blog_id']])->first();
            if ($save){
                $save->delete();
            } else {
                self::create($request);
                $color = 'color--red';
            }
        }
        if (array_key_exists('news_id', $request)){
            $save = self::where(['user_id' => $request['user_id'], 'news_id' => $request['news_id']])->first();
            if ($save){
                $save->delete();
            } else {
                self::create($request);
                $color = 'color--red';
            }
        }
        if (array_key_exists('shop_id', $request)){
            $save = self::where(['user_id' => $request['user_id'], 'shop_id' => $request['shop_id']])->first();
            if ($save){
                $save->delete();
            } else {
                self::create($request);
                $color = 'color--red';
            }
        }
        if (array_key_exists('organizator_id', $request)){
            $save = self::where(['user_id' => $request['user_id'], 'organizator_id' => $request['organizator_id']])->first();
            if ($save){
                $save->delete();
            } else {
                self::create($request);
                $color = 'color--red';
            }
        }
        if (array_key_exists('souvenir_id', $request)){
            $save = self::where(['user_id' => $request['user_id'], 'souvenir_id' => $request['souvenir_id']])->first();
            if ($save){
                $save->delete();
            } else {
                self::create($request);
                $color = 'color--red';
            }
        }

        return $color;
    }
}
