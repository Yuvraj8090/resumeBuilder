<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
     */
    public function rules(): array
    {
        // Get the user ID from the route (e.g., /users/{user})
        $userId = $this->route('user') ? $this->route('user')->id : null;

        return [
            'name' => ['required', 'string', 'max:255'],
            
            // Unique email, but ignore the current user's ID
            'email' => [
                'required', 
                'string', 
                'email', 
                'max:255', 
                Rule::unique('users')->ignore($userId),
            ],

            // Password is nullable on update; only validate if they typed something
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            
            'role_id' => ['required', 'exists:roles,id'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ];
    }
}