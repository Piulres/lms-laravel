<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ContentCategory
 *
 * @package App
 * @property string $title
 * @property string $slug
*/
class ContentCategory extends Model
{
    protected $fillable = ['title', 'slug'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    public static function boot()
    {
        parent::boot();

        ContentCategory::observe(new \App\Observers\UserActionsObserver);
    }
    
}
