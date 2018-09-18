<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class General
 *
 * @package App
 * @property string $site_name
 * @property string $site_logo
 * @property string $theme_color
*/
class General extends Model
{
    use SoftDeletes;

    protected $fillable = ['site_name', 'site_logo', 'theme_color'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    public static function boot()
    {
        parent::boot();

        General::observe(new \App\Observers\UserActionsObserver);
    }
    
}
