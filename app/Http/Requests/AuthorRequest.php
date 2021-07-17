<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorRequest extends FormRequest
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
        // dd($request->method());
        // dd($request->isMethod('POST'));
        return [
            'name_en' => 'required|unique:authors,name_en,' . $request->segment(3),
            'name_ar' => 'required|unique:authors,name_ar,' . $request->segment(3),
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
            'name_en.required' => __('lang.auther name is required'),
            'name_en.unique' => __('lang.auther name already exists'),
            'name_ar.required' => __('lang.auther name is required'),
            'name_ar.unique' => __('lang.auther name already exists'),
        ];
    }
}
