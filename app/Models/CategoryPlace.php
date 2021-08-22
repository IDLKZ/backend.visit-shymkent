<?php

namespace App\Models;

use App\FileUpload;
use App\Searchable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

/**
 * @property integer $id
 * @property integer $parent_id
 * @property string $title_ru
 * @property string $title_kz
 * @property string $title_en
 * @property string $alias
 * @property string $image
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property Categoryplace $categoryplace
 * @property CategoriesPlace[] $categoriesPlaces
 */
class CategoryPlace extends Model
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
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categoryplaces';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['parent_id', 'title_ru', 'title_kz', 'title_en', 'alias', 'image', 'status', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(CategoryPlace::class, 'parent_id');
    }

    public function child()
    {
        return $this->hasMany(CategoryPlace::class,'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categoriesPlaces()
    {
        return $this->hasMany(CategoriesPlace::class, 'category_id');
    }

    public function places(){
        return $this->belongsToMany(Place::class,"categories_places","category_id","place_id");
    }

    public static function getSubCategories($parent)
    {
        return self::where('parent_id', $parent)->get()->toArray();
    }

    /**
     * Построение дерева
     **/
    public static function getTree()
    {
        $raw = self::get()->keyBy("id")->toArray();
        $tree = [];
        foreach ($raw as $id => &$node){
            if(!$node["parent_id"]){
//                $tree = &$node;
               $tree[$id] = &$node;
            }
            else{
                $raw[$node["parent_id"]]["children"][$id] = &$node;
            }
        }
//        $traverse = function ($categories, $prefix = '') use (&$traverse) {
//            foreach ($categories as $category) {
//                echo PHP_EOL.$prefix.' '.$category['title_ru'];
//                if (isset($category['children'])){
//                    $traverse($category['children'], $prefix.'-');
//                }
//            }
//        };
//
//        $traverse($tree);

        return $tree;
    }

    /**
     * @param $data
     * Рендерим вид
     */
    public static function renderTemplate($data, $prefix = '', $category = null) {
        $str = '';
        if(is_array($data)){
            foreach ($data as $item){
                if ($category){
                    $str .= '<option selected="selected" value="'.$category->id.'">'.$category->title_ru.'</option>';
                }
                $str .= '<option value="'.$item['id'].'">';
                $str .= PHP_EOL.$prefix.' '.$item['title_ru'];
                if(isset($item['children'])) {
                    $str .= self::renderTemplate($item['children'], $prefix.'-');
                }
                $str .= '</option>';
            }
        }
        return $str;
    }
}
