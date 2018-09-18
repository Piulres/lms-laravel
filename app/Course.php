<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Course
 *
 * @package App
 * @property integer $order
 * @property string $title
 * @property string $slug
 * @property text $description
 * @property text $introduction
 * @property string $featured_image
 * @property integer $duration
 * @property string $start_date
 * @property string $end_date
 * @property tinyInteger $approved
*/
class Course extends Model
{
    use SoftDeletes;

    protected $fillable = ['order', 'title', 'slug', 'description', 'introduction', 'featured_image', 'duration', 'start_date', 'end_date', 'approved'];
    protected $hidden = [];
    public static $searchable = [
        'title',
        'slug',
        'description',
        'introduction',
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
    public function setOrderAttribute($input)
    {
        $this->attributes['order'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setDurationAttribute($input)
    {
        $this->attributes['duration'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setStartDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['start_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['start_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getStartDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setEndDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['end_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['end_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getEndDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
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
        return $this->belongsToMany(Coursecategory::class, 'course_coursecategory')->withTrashed();
    }
    
    public function tags()
    {
        return $this->belongsToMany(Coursetag::class, 'course_coursetag')->withTrashed();
    }
    
}
