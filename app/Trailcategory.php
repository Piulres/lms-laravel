<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Trailcategory
 *
 * @package App
 * @property string $title
 * @property string $slug
*/
class Trailcategory extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'slug'];
    protected $hidden = [];
    public static $searchable = [
        'title',
        'slug',
    ];
    
    public static function boot()
    {
        parent::boot();

        Trailcategory::observe(new \App\Observers\UserActionsObserver);
    }
    
}
