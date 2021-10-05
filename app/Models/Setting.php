<?php

namespace App\Models;

use App\FileUpload;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $type
 * @property string $title
 * @property string $status
 * @property string $verified
 * @property int $pagination
 * @property string $order
 * @property string $created_at
 * @property string $updated_at
 */
class Setting extends Model
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
    protected $fillable = ['title', 'status', 'verified', 'pagination', 'order', 'created_at', 'updated_at'];


    /**
     * @return string
     */
    /**
     * @return string
     */
    public function getStatusAttribute($value)
    {
        if(in_array($value,[-1,0,1])){
            return [(int)$value];
        }
        else{
            return [-1,0,1];
        }
    }

    /**
     * @return int
     */
    public function getPaginationAttribute($value)
    {
        if($value >0 && $value <= 10000){
            return (int)$value;
        }
        return 15;
    }

    /**
     * @return string
     */
    public function getVerifiedAttribute($value)
    {
        if(in_array($value,[-1,0,1])){
            return [(int)$value];
        }
        else{
            return [-1,0,1];
        }
    }

    /**
     * @return string
     */
    public function getOrderAttribute($value)
    {
        if(in_array($value,["ASC","DESC"])){
            return $value;
        }
        else{
            return "ASC";
        }
    }






}
