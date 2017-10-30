<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveUserRequest extends FormRequest
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
        $rules = [
            "name"     => "required|min:3|max:255",
            "password" => "min:6|max:255|confirmed",
            "email"    => "email|required|unique:users,email" . ($this->user ? "," . $this->user->id : "")
        ];

        if (route('users.create') == $this->getRedirectUrl()) {
            $rules["password"] = "required|" . $rules["password"];
        } else {
            $rules["password"] = "nullable|" . $rules["password"];
        }
        
        return $rules;
    }
}
