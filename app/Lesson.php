<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Lesson
 *
 * @package App
 * @property integer $order
 * @property string $title
 * @property string $slug
 * @property text $introduction
 * @property text $content
 * @property string $study_material
*/
class Lesson extends Model
{
    use SoftDeletes;

    protected $fillable = ['order', 'title', 'slug', 'introduction', 'content', 'study_material'];
    protected $hidden = [];
    public static $searchable = [
        'title',
        'slug',
        'introduction',
        'content',
    ];
    
    public static function boot()
    {
        parent::boot();

        Lesson::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setOrderAttribute($input)
    {
        $this->attributes['order'] = $input ? $input : null;
    }
    
}
