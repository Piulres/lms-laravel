<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Trailscategory
 *
 * @package App
 * @property string $title
*/
class Trailscategory extends Model
{
    use SoftDeletes;

    protected $fillable = ['title'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    public static function boot()
    {
        parent::boot();

        Trailscategory::observe(new \App\Observers\UserActionsObserver);
    }
    
}
