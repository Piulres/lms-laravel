<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCoursesRequest extends FormRequest
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
            'order' => 'max:2147483647|nullable|numeric',
            'featured_image' => 'nullable|mimes:png,jpg,jpeg,gif',
            'instructor.*' => 'exists:users,id',
            'lessons.*' => 'exists:lessons,id',
            'duration' => 'max:2147483647|nullable|numeric',
            'start_date' => 'nullable|date_format:'.config('app.date_format'),
            'end_date' => 'nullable|date_format:'.config('app.date_format'),
            'categories.*' => 'exists:coursecategories,id',
            'tags.*' => 'exists:coursetags,id',
        ];
    }
}
