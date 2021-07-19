<?php


namespace App;


use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

trait Language
{
    public function getTitleAttribute()
    {
        return $this["title_" . LaravelLocalization::getCurrentLocale()];
    }

    public function getDescriptionAttribute()
    {
        return $this["description_" . LaravelLocalization::getCurrentLocale()];
    }

    public function getButtonAttribute()
    {
        return $this["button_" . LaravelLocalization::getCurrentLocale()];
    }
}
