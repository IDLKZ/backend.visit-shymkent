<?php

namespace App\Models;

use App\FileUpload;
use App\Recovery;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * @var array
     */
    protected $fillable = ['role_id', 'name', 'email', 'phone', 'password', 'image', 'description', 'status', 'verified', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo('App\Role', 'role_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blogs()
    {
        return $this->hasMany('App\Blog', 'author_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function news()
    {
        return $this->hasMany('App\News', 'author_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function organizators()
    {
        return $this->hasMany(Organizator::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recoveries()
    {
        return $this->hasMany(Recovery::class,"user_id");
    }
    public function savings()
    {
        return $this->hasMany(Saving::class,"user_id");
    }
    public function reviews()
    {
        return $this->hasMany(Review::class,"user_id");
    }



    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shops()
    {
        return $this->hasMany(Shop::class, 'user_id');
    }


    use FileUpload;



    public static function createFromRegister($request){
        $model = new self();
        $input = $request->all();
        $input["role_id"] = 3;
        $input["status"] = 0;
        $input["verified"] = 0;
        $input["password"] = bcrypt($request->password);
        $model->fill($input);
        if($model->save()){
            return $model->id;
        }
        else{

            return false;
        }
    }








}
