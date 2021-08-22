<?php

namespace App\Models;

use App\FileUpload;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property string $image
 * @property string $created_at
 * @property string $updated_at
 */
class Partner extends Model
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
    protected $fillable = ['title', 'alias', 'image', 'created_at', 'updated_at'];

}
