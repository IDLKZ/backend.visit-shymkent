<?php


namespace App;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait FileUpload
{
    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            // ... code here
        });

        self::created(function($model){
            // ... code here
            toastSuccess(__("messages.created"));
        });

        self::updating(function($model){
            // ... code here
        });

        self::updated(function($model){
            // ... code here
            toastSuccess(__("messages.updated"));

        });

        self::deleting(function($model){
            $model->removeFile('image');
        });

        self::deleted(function($model){
            // ... code here
            toastInfo(__("messages.deleted"));

        });
    }


    public static function add($fields)
    {
        $post = new static;
        $post->fill($fields);
        $post->save();
        return $post;
    }

    public function edit($fields, $path = null)
    {
        if($path !== null){
            $fields[$path] = $this->$path;
        }
        $this->fill($fields);
        $this->save();
    }

    public function remove($path)
    {
        $this->removeFile($path);
        $this->delete();
    }

    public function removeFile($path)
    {
        if($this->$path != null)
        {
            if (Storage::exists('uploads/' . $this->$path)){
                Storage::delete('uploads/' . $this->$path);
            }
        }
    }

    public function uploadFile($file, $path)
    {
        if($file == null) { return; }
        $this->removeFile($path);
        $filename = Str::random(10) . '.' . $file->extension();
        $file->storeAs('uploads', $filename);
        $this->$path = $filename;
        $this->save();
    }

    public function getFile($path)
    {
        if($this->$path == null)
        {
            return '/images/no-image.png';
        }
        elseif (strpos($this.$path,"eventum.one")){
            return $this->image;
        }
        else{
            return '/uploads/' . $this->$path;
        }

    }


}
