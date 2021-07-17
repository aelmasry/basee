<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Book;
use Illuminate\Http\Request;

class BookRequest extends FormRequest
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
        // return Book::$rules;
        return [
            'name_en' => 'required|string|max:255|unique:books,name_en,' . $request->segment(3),
            'brief_en' => 'required|string',
            'name_ar' => 'required|string|max:255|unique:books,name_en,' . $request->segment(3),
            'brief_ar' => 'required|string',
            'type' => 'required|string',
            'duration' => 'required|integer',
            'author_id' => 'required',
            'narrator_id' => 'required',
            'category_id' => 'required',
            'status' => 'required|boolean',
        ];
    }

}
