<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssociationCompanyRequest extends FormRequest
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
            'users'=> 'required|array',
            'users.*'=> 'required|integer|exists:users,id|unique:usuarios_has_empresas,users_id',
        ];
    }
}
