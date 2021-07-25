<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Language extends Model
{
    use HasFactory;



    public static function getTitle(){
        return "title_" . LaravelLocalization::getCurrentLocale();
    }

    public static function getDescription(){
        return "description_" . LaravelLocalization::getCurrentLocale();
    }

    public static function getButton(){
        return "button_" . LaravelLocalization::getCurrentLocale();
    }

    public static function getEducation(){
        return "education_" . LaravelLocalization::getCurrentLocale();

    }
}
