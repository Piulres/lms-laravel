<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrailsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'courses.*' => 'exists:courses,id',
            'start_date' => 'nullable|date_format:'.config('app.date_format'),
            'end_date' => 'nullable|date_format:'.config('app.date_format'),
            'categories.*' => 'exists:trailcategories,id',
            'tags.*' => 'exists:trailtags,id',
        ];
    }
}
