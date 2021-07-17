<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Narrator;
use Illuminate\Http\Request;

class NarratorRequest extends FormRequest
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
            'name_en' => 'required|unique:narrators,name_en,' . $request->segment(3),
            'name_ar' => 'required|unique:narrators,name_ar,' . $request->segment(3),
            'brief_en' => 'required',
            'brief_ar' => 'required',
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
            'name_en.required' => __('lang.narrator name is required'),
            'name_en.unique' => __('lang.narrator name already exists'),
            'name_ar.required' => __('lang.narrator arabic name is required'),
            'name_ar.unique' => __('lang.narrator arabic name already exists'),
            'brief_en.required' => __('lang.narrator brief is required'),
            'brief_ar.required' => __('lang.narrator arabic brief is required'),
        ];
    }
}
