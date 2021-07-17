<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


/**
 * @property integer $id
 * @property integer $user_id
 * @property string $code
 * @property int $type
 * @property string $expiration_date
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 */
class Recovery extends Model
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
    protected $fillable = ['user_id', 'code', 'type', 'expiration_date', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }




    public static function newUserVerification($user_id){
        if($recovery = self::firstWhere(["user_id"=>$user_id,"type"=>1])){
            $recovery->delete();
        }
        $input["user_id"] = $user_id;
        $input["code"] = Str::random(16);
        $input["type"] = 1;
        $input["expiration_date"] = Carbon::now()->addDay();
        $model = new self();
        if($model->fill($input)->save()){
            return $model->id;
        }
        else{
            return false;
        }
    }

    public static function recoverAccount($user_id){
        if($recovery = self::firstWhere(["user_id"=>$user_id,"type"=>2])){
            $recovery->delete();
        }
        $input["user_id"] = $user_id;
        $input["code"] = Str::random(16);
        $input["type"] = 2;
        $input["expiration_date"] = Carbon::now()->addDay();
        $model = new self();
        if($model->fill($input)->save()){
            return $model->id;
        }
        else{
            return false;
        }
    }
}
