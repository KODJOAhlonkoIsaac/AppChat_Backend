<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

class RegisterRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|min:5',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Le champ nom est requis.',
            'name.min' => 'Le champ nom doit contenir au moins 5 caractères.',
            'email.required' => 'Le champ email est requis.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'password.required' => 'Le champ mot de passe est requis.',
            'password.min' => 'Le champ mot de passe doit contenir au moins 8 caractères.',

           
            
        ];
    }
//     protected function failedValidaT(Validator $validator)
// {
//     throw new HttpResponseException(response()->json([
//         'success'   => false,
//         'message'   => 'Erreurs de validation',
//         'data'      => $validator->errors()
//     ], 422));
// }
}
