<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Coursecategory
 *
 * @package App
 * @property string $title
 * @property string $slug
*/
class Coursecategory extends Model
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

        Coursecategory::observe(new \App\Observers\UserActionsObserver);
    }
    
}
