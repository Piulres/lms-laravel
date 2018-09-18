<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterByUser;

/**
 * Class Trailtag
 *
 * @package App
 * @property string $title
 * @property string $slug
*/
class Trailtag extends Model
{
    use SoftDeletes, FilterByUser;

    protected $fillable = ['title', 'slug'];
    protected $hidden = [];
    public static $searchable = [
        'title',
        'slug',
    ];
    
    public static function boot()
    {
        parent::boot();

        Trailtag::observe(new \App\Observers\UserActionsObserver);
    }
    
}
