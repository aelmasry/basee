<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Author;
use Illuminate\Http\Request;

class AudioRequest extends FormRequest
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
        if($request->isMethod('PATCH'))
        {
            return $this->onUpdate($request);
        }else
        {
            return $this->onCreate($request);
        }
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name_en.required' => __('lang.name is required'),
            'name_en.unique' => __('lang.name already exists'),
            'name_ar.required' => __('lang.name is required'),
            'name_ar.unique' => __('lang.name already exists'),
        ];
    }

    protected function onCreate($request)
    {
        return [
            'name_en' => 'required|unique:audios,name_en,' . $request->segment(3),
            'name_ar' => 'required|unique:audios,name_ar,' . $request->segment(3),
            'file' => 'required|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav|max:100048'
        ];
    }


    protected function onUpdate($request)
    {
        return [
            'name_en' => 'required|unique:audios,name_en,' . $request->segment(3),
            'name_ar' => 'required|unique:audios,name_ar,' . $request->segment(3),
            'file' => 'nullable|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav|max:100048'
        ];
    }

}
