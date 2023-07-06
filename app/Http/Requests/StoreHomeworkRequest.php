<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHomeworkRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'training_id' => 'required',
            'module_id' => 'required',
            'lecture_id' => 'required',
            'titles.*' => 'required',
            'description.*' => 'required',
        ];
    }
}
