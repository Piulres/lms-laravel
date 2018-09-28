<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreDatacoursesRequest extends FormRequest
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
            'view' => 'max:2147483647|nullable|numeric',
            'progress' => 'max:2147483647|nullable|numeric',
            'rating' => 'max:2147483647|nullable|numeric',
            'testimonal' => 'max:2147483647|nullable',
            'course_id' => 'max:2147483647|nullable|numeric',
            'user_id' => 'max:2147483647|nullable|numeric',
        ];
    }
}
