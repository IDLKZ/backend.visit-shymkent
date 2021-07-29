<?php

namespace App\Models;

use App\FileUpload;
use App\Language;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $title_ru
 * @property string $title_kz
 * @property string $title_en
 * @property string $description_ru
 * @property string $description_kz
 * @property string $description_en
 * @property string $button_ru
 * @property string $button_kz
 * @property string $button_en
 * @property string $link
 * @property string $image
 * @property int $number
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 */
class Slider extends Model
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
    protected $fillable = ['title_ru', 'title_kz', 'title_en', 'description_ru', 'description_kz', 'description_en', 'button_ru', 'button_kz', 'button_en', 'link', 'image', 'number', 'status', 'created_at', 'updated_at'];

    protected $casts = ['status' => 'integer'];

    use FileUpload;
    use Language;

}
