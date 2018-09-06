<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Trail
 *
 * @package App
 * @property string $title
*/
class Trail extends Model
{
    use SoftDeletes;

    protected $fillable = ['title'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    public static function boot()
    {
        parent::boot();

        Trail::observe(new \App\Observers\UserActionsObserver);
    }
    
    public function categories()
    {
        return $this->belongsToMany(Trailscategory::class, 'trail_trailscategory')->withTrashed();
    }
    
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_trail')->withTrashed();
    }
    
}
