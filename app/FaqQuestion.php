<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FaqQuestion
 *
 * @package App
 * @property string $category
 * @property text $question_text
 * @property text $answer_text
*/
class FaqQuestion extends Model
{
    protected $fillable = ['question_text', 'answer_text', 'category_id'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    public static function boot()
    {
        parent::boot();

        FaqQuestion::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCategoryIdAttribute($input)
    {
        $this->attributes['category_id'] = $input ? $input : null;
    }
    
    public function category()
    {
        return $this->belongsTo(FaqCategory::class, 'category_id');
    }
    
}
