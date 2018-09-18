<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreContentPagesRequest extends FormRequest
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
            'title' => 'required',
            'category_id.*' => 'exists:content_categories,id',
            'tag_id.*' => 'exists:content_tags,id',
            'featured_image' => 'nullable|mimes:png,jpg,jpeg,gif',
        ];
    }
}
