<?php

namespace App\Models;

use App\FileUpload;
use App\Searchable;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $place_id
 * @property integer $type_id
 * @property string $title_ru
 * @property string $title_kz
 * @property string $title_en
 * @property string $description_ru
 * @property string $description_kz
 * @property string $description_en
 * @property string $alias
 * @property string $eventum
 * @property mixed $phone
 * @property mixed $social_networks
 * @property mixed $sites
 * @property string $address
 * @property string $address_link
 * @property string $price
 * @property string $image
 * @property mixed $ratings
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property Place $place
 * @property EventType $eventType
 * @property CategoriesEvent[] $categoriesEvents
 * @property Gallery[] $galleries
 * @property Workday[] $workdays
 */
class Event extends Model
{

    use Sluggable;
    use FileUpload;
    use \App\Language;
    use Searchable;

    public function sluggable(): array
    {
        return [
            'alias' => [
                'source' => 'title_ru'
            ]
        ];
    }

    protected $casts = [
        'phone' => 'object',
        'social_networks' => 'object',
        'sites' => 'object',
    ];
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

   public $date_start_format;
   public $date_end_format;
    /**
     * @var array
     */
    protected $fillable = ['organizator_id', 'type_id', 'place_id', 'title_ru', 'title_kz', 'title_en', 'description_ru', 'description_kz', 'description_en', 'alias', 'eventum', 'phone', 'social_networks', 'sites', 'address', 'address_link', 'price', 'image', 'ratings', 'status', 'created_at', 'updated_at','by_user','event_id'];

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
    public function eventType()
    {
        return $this->belongsTo(EventType::class, 'type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categoriesEvents()
    {
        return $this->belongsToMany(CategoryEvents::class,"categories_events","event_id","category_id");
    }

    public function categoryEvent()
    {
        return $this->hasMany(CategoryEvent::class);
    }

    public function category()
    {
        return $this->belongsToMany(CategoryEvents::class,"categories_events","event_id","category_id");
    }

    public function savings()
    {
        return $this->hasMany(Saving::class, 'event_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'event_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, 'event_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function workdays()
    {
        return $this->hasMany(Workday::class);
    }
    public function placeEvent()
    {
        return $this->hasMany(PlaceEvent::class,"event_id");
    }

    public function eventumEvent(){
        return $this->hasOne(EventumEvent::class,"event_id","event_id");
    }

    public function byUser(){
        return $this->belongsTo(User::class,"by_user");
    }

    public function places(){
        return $this->hasManyThrough(
            Place::class,
            PlaceEvent::class,
            "event_id",
            "id",
            "id",
            "place_id"
        );
    }


    public static function makeData($item){
        $input["event_id"] = $item["eventId"];
        $input["type_id"] = $item["isService"] ? 2 : 1;
        if($place = Place::find($item["placeId"])){
            $input["place_id"] = $place->id;
        }
        $input["title_ru"] = $item["nameRu"] ? $item["nameRu"] : "-";
        $input["title_kz"] = $item["nameKz"] ? $item["nameKz"] : "-";
        $input["title_en"] = $item["nameEn"] ? $item["nameEn"] : "-";
        $input["description_ru"] = $item["descriptionRu"] ? $item["descriptionRu"] : "-";
        $input["description_kz"] = $item["descriptionKz"] ? $item["descriptionKz"] : "-";
        $input["description_en"] = $item["descriptionEn"] ? $item["descriptionEn"] : "-";
        $input["phone"] = $item["phones"] ? [$item["phones"]] : null;
        $item["instagramUrl"] ? $input["social_networks"][0] = $item["instagramUrl"] : null;
        $item["facebookUrl"] ? $input["social_networks"][1] = $item["facebookUrl"] : null;
        $item["webSiteUrl"] ? $input["sites"][0] = $item["webSiteUrl"] : null;
        $input["price"] = $item["price"];
        $input["image"] = $item["posterUrl"];
        $input["status"] = -1;
        return $input;
    }


    public static function makeWorkdays($item,$event){
        $event->workdays()->delete();
        foreach ($item["seances"] as $seance){
            $input = [];
            $weekNum = 0;
            if($seance["showOnMonday"]){
                $input["event_id"] = $event->id;
                $input["weekday_id"] = 3;
                if($seance["beginDt"]){
                    $input["date_start"]  = Carbon::parse($seance["beginDt"])->format("d/m/Y");
                    $input["time_start"] = Carbon::parse($seance["beginDt"])->format("H:i");
                }
                $workday = Workday::add($input);
                $weekNum++;
            }
            if($seance["showOnTuesday"]){
                $input["event_id"] = $event->id;
                $input["weekday_id"] = 4;
                if($seance["beginDt"]){
                    $input["date_start"]  = Carbon::parse($seance["beginDt"])->format("d/m/Y");
                    $input["time_start"] = Carbon::parse($seance["beginDt"])->format("H:i");
                }
                $workday = Workday::add($input);
                $weekNum++;
            }
            if($seance["showOnWednesday"]){
                $input["event_id"] = $event->id;
                $input["weekday_id"] = 5;
                if($seance["beginDt"]){
                    $input["date_start"]  = Carbon::parse($seance["beginDt"])->format("d/m/Y");
                    $input["time_start"] = Carbon::parse($seance["beginDt"])->format("H:i");
                }
                $workday = Workday::add($input);
                $weekNum++;
            }
            if($seance["showOnThursday"]){
                $input["event_id"] = $event->id;
                $input["weekday_id"] = 6;
                if($seance["beginDt"]){
                    $input["date_start"]  = Carbon::parse($seance["beginDt"])->format("d/m/Y");
                    $input["time_start"] = Carbon::parse($seance["beginDt"])->format("H:i");
                }
                $workday = Workday::add($input);
                $weekNum++;
            }
            if($seance["showOnFriday"]){
                $input["event_id"] = $event->id;
                $input["weekday_id"] = 7;
                if($seance["beginDt"]){
                    $input["date_start"]  = Carbon::parse($seance["beginDt"])->format("d/m/Y");
                    $input["time_start"] = Carbon::parse($seance["beginDt"])->format("H:i");
                }
                $workday = Workday::add($input);
                $weekNum++;
            }
            if($seance["showOnSaturday"]){
                $input["event_id"] = $event->id;
                $input["weekday_id"] = 8;
                if($seance["beginDt"]){
                    $input["date_start"]  = Carbon::parse($seance["beginDt"])->format("d/m/Y");
                    $input["time_start"] = Carbon::parse($seance["beginDt"])->format("H:i");
                }
                $workday = Workday::add($input);
                $weekNum++;
            }
            if($seance["showOnSunday"]){
                $input["event_id"] = $event->id;
                $input["weekday_id"] = 9;
                if($seance["beginDt"]){
                    $input["date_start"]  = Carbon::parse($seance["beginDt"])->format("d/m/Y");
                    $input["time_start"] = Carbon::parse($seance["beginDt"])->format("H:i");
                }
                $workday = Workday::add($input);
                $weekNum++;
            }
            if($weekNum == 0){
                $input["event_id"] = $event->id;
                $input["weekday_id"] = 2;
                if($seance["beginDt"]){
                    $input["date_start"]  = Carbon::parse($seance["beginDt"])->format("d/m/Y");
                    $input["time_start"] = Carbon::parse($seance["beginDt"])->format("H:i");
                }
                $workday = Workday::add($input);
            }
        }
    }






}
