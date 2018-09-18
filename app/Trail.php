<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Trail
 *
 * @package App
 * @property string $order
 * @property string $title
 * @property string $slug
 * @property text $description
 * @property text $introduction
 * @property string $featured_image
 * @property string $start_date
 * @property string $end_date
 * @property tinyInteger $approved
*/
class Trail extends Model
{
    use SoftDeletes;

    protected $fillable = ['order', 'title', 'slug', 'description', 'introduction', 'featured_image', 'start_date', 'end_date', 'approved'];
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

        Trail::observe(new \App\Observers\UserActionsObserver);
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
    
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_trail')->withTrashed();
    }
    
    public function categories()
    {
        return $this->belongsToMany(Trailcategory::class, 'trail_trailcategory')->withTrashed();
    }
    
    public function tags()
    {
        return $this->belongsToMany(Trailtag::class, 'trail_trailtag')->withTrashed();
    }
    
}
