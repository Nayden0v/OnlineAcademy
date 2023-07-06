<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDetailsRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Позволете валидацията на всички
    }

    public function rules()
    {
        return [
            'repository' => 'required|array',
            'repository.*' => 'required',
            'student_id' => 'required',
            'language' => 'required|array',
            'language.*' => 'required',
            'score' => 'required|array',
            'score.*' => 'required',
            'url' => 'required|array',
            'url.*' => 'required',
            'name' => 'required|array',
            'name.*' => 'required',
            'messenger' => 'required',
            'hobby' => 'required|array',
            'hobby.*' => 'required',
            'skill' => 'required|array',
            'skill.*' => 'required',
        ];
    }
}