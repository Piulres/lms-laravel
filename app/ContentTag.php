<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ContentTag
 *
 * @package App
 * @property string $title
 * @property string $slug
*/
class ContentTag extends Model
{
    protected $fillable = ['title', 'slug'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    public static function boot()
    {
        parent::boot();

        ContentTag::observe(new \App\Observers\UserActionsObserver);
    }
    
}
