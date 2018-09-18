<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FaqCategory
 *
 * @package App
 * @property string $title
*/
class FaqCategory extends Model
{
    protected $fillable = ['title'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    public static function boot()
    {
        parent::boot();

        FaqCategory::observe(new \App\Observers\UserActionsObserver);
    }
    
}
