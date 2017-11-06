<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveQuestionRequest extends FormRequest
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
    public function rules()
    {
        return [
            "category_id"   => "exists:categories,id",
            "tags"          => "string|regex:/^([a-z0-9]+(,\s){0,1})+([a-z0-9,\s])$/",
            "question_text" => "string|required",
            "answer_text"   => "string|required"
        ];
    }
}
