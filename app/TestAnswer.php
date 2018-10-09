<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class TestAnswer
 *
 * @package App
 * @property string $question
 * @property string $option
 * @property tinyInteger $correct
*/
class TestAnswer extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'test_id', 'question_id', 'option_id', 'correct'];

    public static function boot()
    {
        parent::boot();

        TestAnswer::observe(new \App\Observers\UserActionsObserver);
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
