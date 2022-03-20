<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGrades extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'Name' => 'required|unique:grades,name->ar,'.$this->id,  // $this->id كدا هياخد ال id معاه عشان لو جيت تعدل ف نفس الصف بتاع ال id دا بنفس البيانات يقبلها عادي غير كدا لا
            'Name_en' => 'required|unique:grades,name->en,'.$this->id, // عشان يسمحلي اعدل عليه لو انا ف نفس ال id  دا غير كدا ميكرروش
        ];
    }

    public function messages()
    {
        return [
            'Name.required' => trans('validation.required'),
            'Name.unique' => trans('validation.unique'),
            'Name_en.required' => trans('validation.required'),
            'Name_en.unique' => trans('validation.unique'),
        ];
    }
}
