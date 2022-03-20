<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassroom extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'List_Classes.*.Name' => 'required',    // 'List_Classes.*.Name' عملتها كدا عشان هي عباره عن Array
            'List_Classes.*.Name_class_en' => 'required',
        ];
    }

    public function messages()
    {
        return [
               'Name.required' => trans('validation.required'),
               'Name_class_en.required' => trans('validation.required'),
        ];
    }
}
