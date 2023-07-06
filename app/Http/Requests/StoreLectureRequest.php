<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLectureRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'lecture_title.*' => 'required',
            'lecture_description.*' => 'required',
            'lecture_date.*' => 'required',
            'module_id' => 'required',
            'training_id' => 'required',
        ];
    }
}
