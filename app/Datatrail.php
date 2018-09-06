<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Datatrail
 *
 * @package App
 * @property string $trail
 * @property string $user
 * @property tinyInteger $view
 * @property integer $progress
 * @property integer $rating
*/
class Datatrail extends Model
{
    use SoftDeletes;

    protected $fillable = ['view', 'progress', 'rating', 'trail_id', 'user_id'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    public static function boot()
    {
        parent::boot();

        Datatrail::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setTrailIdAttribute($input)
    {
        $this->attributes['trail_id'] = $input ? $input : null;
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
    
    public function trail()
    {
        return $this->belongsTo(Trail::class, 'trail_id')->withTrashed();
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
