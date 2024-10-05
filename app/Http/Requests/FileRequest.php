<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
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
            'file' => 'required|mimes:pdf,doc,docx,png,jpg,jpeg,txt|max:1048',
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'Le champ fichier est requis.',
            'file.mimes' => 'Le fichier doit être au format pdf, doc, docx, png, jpg, jpeg ou txt.',
            'file.max' => 'Le fichier ne doit pas dépasser 10 Mo.',
        ];
    }
}
