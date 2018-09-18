<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Datacourse
 *
 * @package App
 * @property integer $view
 * @property integer $progress
 * @property integer $rating
 * @property text $testimonal
 * @property string $user
 * @property string $course
 * @property string $certificate
*/
class Datacourse extends Model
{
    use SoftDeletes;

    protected $fillable = ['view', 'progress', 'rating', 'testimonal', 'user_id', 'course_id', 'certificate_id'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    public static function boot()
    {
        parent::boot();

        Datacourse::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setViewAttribute($input)
    {
        $this->attributes['view'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setProgressAttribute($input)
    {
        $this->attributes['progress'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setRatingAttribute($input)
    {
        $this->attributes['rating'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setUserIdAttribute($input)
    {
        $this->attributes['user_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCourseIdAttribute($input)
    {
        $this->attributes['course_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCertificateIdAttribute($input)
    {
        $this->attributes['certificate_id'] = $input ? $input : null;
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id')->withTrashed();
    }
    
    public function certificate()
    {
        return $this->belongsTo(Coursescertificate::class, 'certificate_id')->withTrashed();
    }
    
}
