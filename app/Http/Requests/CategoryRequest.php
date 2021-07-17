<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'name_en' => 'required|unique:categories,name_en,' . $request->segment(3),
            'name_ar' => 'required|unique:categories,name_ar,' . $request->segment(3),
            // 'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name_en.required' => __('lang.category name is required'),
            'name_en.unique' => __('lang.category name already exists'),
            'name_ar.required' => __('lang.category name is required'),
            'name_ar.unique' => __('lang.category name already exists'),
        ];
    }
}
