<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCoursesRequest extends FormRequest
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
            
            'instructor.*' => 'exists:users,id',
            'lessons.*' => 'exists:lessons,id',
            'categories.*' => 'exists:coursescategories,id',
            'featured_image' => 'nullable|mimes:png,jpg,jpeg,gif',
            'duration' => 'max:2147483647|nullable|numeric',
        ];
    }
}
