<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Change to true so the controller lets the request pass
        return true; 
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'confirmed' looks for a matching password_confirmation field in your form
            'password' => ['required', 'string', 'min:8', 'confirmed'], 
            'role_id' => ['required', 'exists:roles,id'],
            'photo' => ['nullable', 'image', 'max:2048'], // Validates profile photo upload
        ];
    }
}