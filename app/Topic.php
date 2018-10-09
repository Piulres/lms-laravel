<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Topic
 *
 * @package App
 * @property string $title
*/
class Topic extends Model
{
    use SoftDeletes;

    protected $fillable = ['title'];

    public static function boot()
    {
        parent::boot();

        Topic::observe(new \App\Observers\UserActionsObserver);
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'topic_id')->withTrashed();
    }
}
