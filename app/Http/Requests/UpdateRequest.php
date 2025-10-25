<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     * 
     */
    public function rules(): array
    {
        return [
            "name" => "sometimes|string|max:255",
            "email" => "sometimes|string|email|unique:user,email",
            "current_password" => "required_with:password|string",
            "password" => "sometimes|string|min:8|max:16|confirmed"
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->filled("password") && $this->filled("current_password")) {
                $isRightPassword = Hash::check($this->input("current_password"), $this->user()->password);

                if (!$isRightPassword) {
                    $validator->errors()->add('current_password', 'The provided password does not match your current password.');
                };
            }
        });
    }
}
