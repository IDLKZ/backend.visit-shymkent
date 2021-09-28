<?php

namespace App\Models;

use App\FileUpload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

/**
 * @property integer $id
 * @property string $updateFrom
 * @property string $updateTo
 * @property string $totalCount
 * @property string $created_at
 * @property string $updated_at
 * @property EventumEvent[] $eventumEvents
 */
class Cron extends Model
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
    protected $fillable = ['updateFrom', 'updateTo', 'totalCount', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function eventumEvents()
    {
        return $this->hasMany('App\Models\EventumEvent');
    }


    public static function getLatestEvents($machine = false){
        //Создаем отсчет до поиска
        $updatedFrom = null;
        $updatedTo = $now = Carbon::now()->format("Y-m-d") . "T" . Carbon::now()->format("H:i:s");
        if($machine){
            if(Cron::count() > 0){
                $crons = Cron::latest()->first();
                $updatedFrom = $crons->updateTo;
            }
        }

        //Получаем ответ от Eventum
        $response = self::requestToEventum($updatedFrom,$updatedTo);
        $allData = self::requestToEventum($updatedFrom,$updatedTo,0,$response["totalCount"]);
            foreach ($allData["events"] as $item){
                //Существует ли в БД
                if($event = Event::firstWhere("event_id",$item["eventId"])){
                    //Если существует
                    if($eventEventum = EventumEvent::firstWhere("event_id",$event->event_id)){
                        //Проверить обновлен ли?
                        if(Carbon::parse($eventEventum->current_updated)->format("Y-m-d H:i:s") < Carbon::parse($item["updated"])->format("Y-m-d H:i:s")){
                            //Да обновлен
                            $event->status = -1;
                            $input = Event::makeData($item);
                            $event->edit($input);
                            Event::makeWorkdays($item,$event);
                            $event->edit($input);
                            $eventEventum->status = 0;
                            $eventEventum->current_updated = $item["updated"];
                            $eventEventum->last_updated = null;
                            $eventEventum->save();
                        }
                        else{
                            null;
                        }
                    }
                    else{
                        //Почему-то не существует в таблице изменений событий с евентума
                        $event->status = -1;
                        $eventEventum = new EventumEvent();
                        $eventEventum->event_id = $event->event_id;
                        $eventEventum->status = 0;
                        $eventEventum->current_updated = $item["updated"];
                        $eventEventum->last_updated = null;
                        $event->save();
                        $eventEventum->save();
                    }
                }
                else{
                    //Не существует в БД
                    //1.Создаем новый events
                    $input = Event::makeData($item);
                    $event = Event::add($input);
                    //WorkDays and Weekdays
                    Event::makeWorkdays($item,$event);
                    //2.Создаем Eventum Events
                    $eventEventum = new EventumEvent();
                    $eventEventum->event_id = $event->event_id;
                    $eventEventum->status = 0;
                    $eventEventum->current_updated = $item["updated"];
                    $eventEventum->last_updated = null;
                    $eventEventum->save();
                }

            }
            if($machine){
                $cron = Cron::add(['updateFrom'=>$updatedFrom, 'updateTo'=>$updatedTo, 'totalCount'=>$response["totalCount"]]);
            }

    }


    public static function requestToEventum($updateFrom=null,$updateTo=null,$page = null,$pageSize = 8,$eventId=null){
        $endpoint = "https://api.eventum.one/v1/Event/Find";
        $client = new \GuzzleHttp\Client();
        $token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJlYjliNmZmYi1iODQ0LTQxZWUtOTgxNi02ODRlYWM5NWI0M2EiLCJqdGkiOiJlYjliNmZmYi1iODQ0LTQxZWUtOTgxNi02ODRlYWM5NWI0M2EiLCJodHRwOi8vc2NoZW1hcy54bWxzb2FwLm9yZy93cy8yMDA1LzA1L2lkZW50aXR5L2NsYWltcy9uYW1laWRlbnRpZmllciI6ImViOWI2ZmZiLWI4NDQtNDFlZS05ODE2LTY4NGVhYzk1YjQzYSIsImh0dHA6Ly9zY2hlbWFzLnhtbHNvYXAub3JnL3dzLzIwMDUvMDUvaWRlbnRpdHkvY2xhaW1zL25hbWUiOiJoZWxsb0BvdGlja3MuY29tIiwiaHR0cDovL3NjaGVtYXMubWljcm9zb2Z0LmNvbS93cy8yMDA4LzA2L2lkZW50aXR5L2NsYWltcy9yb2xlIjoiVElDS0VUT1BFUkFUT1IiLCJuYmYiOjE2MjY1OTI2MTIsImV4cCI6MTY1ODEyODYxMiwiaXNzIjoiaHR0cDovL2xvY2FsaG9zdDo1MDAxLyIsImF1ZCI6Imh0dHA6Ly9sb2NhbGhvc3Q6NTAwMS8ifQ.m1j0d_JbU2R1pi9RD7ovm_XAwyDUYwpNONTBj6XXJaw";
        $response = $client->request('GET', $endpoint,
            ['headers' =>
                [
                    'Authorization' => "Bearer {$token}"
                ],
                'query' => [
                    "updatedFrom"=> $updateFrom,
                    "updatedTo"=> $updateTo,
                    "pageIndex"=> $page,
                    "pageSize"=> $pageSize,
                    "eventId"=>$eventId
                ]
            ],
        )->getBody()->getContents();
        return json_decode($response,JSON_OBJECT_AS_ARRAY);
    }


    public static function checkEvent($eventId){

        $response = self::requestToEventum(null,null,0,100,$eventId);
        $item = $response["events"][0];
        if($event = Event::firstWhere("event_id",$item["eventId"])){
            //Если существует
            if($eventEventum = EventumEvent::firstWhere("event_id",$event->event_id)){
                //Проверить обновлен ли?
                if(Carbon::parse($eventEventum->current_updated)->format("Y-m-d H:i:s") < Carbon::parse($item["updated"])->format("Y-m-d H:i:s")){
                    //Да обновлен
                    $event->status = -1;
                    $input = Event::makeData($item);
                    $event->edit($input);
                    Event::makeWorkdays($item,$event);
                    $event->edit($input);
                    $eventEventum->status = 0;
                    $eventEventum->current_updated = $item["updated"];
                    $eventEventum->last_updated = null;
                    $eventEventum->save();
                    toastSuccess("Обновлена самая новая версия!");

                }
                else{
                     toastSuccess("Обновлений нет!");
                }
            }
            else{
                //Почему-то не существует в таблице изменений событий с евентума
                $event->status = -1;
                $eventEventum = new EventumEvent();
                $eventEventum->event_id = $event->event_id;
                $eventEventum->status = 0;
                $eventEventum->current_updated = $item["updated"];
                $eventEventum->last_updated = null;
                $event->save();
                $eventEventum->save();
                toastSuccess("Обновлена самая новая версия!");
            }

        }





    }

}
