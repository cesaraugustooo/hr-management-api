<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VagaRequest extends FormRequest
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
			'titulo' => 'required|string',
			'descricao' => 'required|string',
			'localizacao' => 'required|string',
			'remoto' => 'required',
			'tipo_contrato' => 'required|string',
			'salario_min' => 'required|numeric',
			'salario_max' => 'required|numeric',
			'nivel_experiencia' => 'required|string',
			'requisitos' => 'required|string',
			'diferenciais' => 'required|string',
			'carga_horaria_semanal' => 'required|numeric',
			'beneficios' => 'string',
			'status' => 'required|in:Aberta,Pausada,Cancelada,Preenchida',
        ];
    }
}
