<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Course
 *
 * @package App
 * @property string $title
 * @property string $featured_image
 * @property text $description
 * @property text $introduction
 * @property integer $duration
*/
class Course extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'featured_image', 'description', 'introduction', 'duration'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    public static function boot()
    {
        parent::boot();

        Course::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setDurationAttribute($input)
    {
        $this->attributes['duration'] = $input ? $input : null;
    }
    
    public function instructor()
    {
        return $this->belongsToMany(User::class, 'course_user');
    }
    
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'course_lesson')->withTrashed();
    }
    
    public function categories()
    {
        return $this->belongsToMany(Coursescategory::class, 'course_coursescategory')->withTrashed();
    }
    
}
