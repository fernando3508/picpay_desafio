<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
          'nome' => [
            'max:255',
            new \App\Rules\NomeCompletoRule()
          ]
          'cpf' => [
            Rule::unique('user')->ignore($this->user, 'id_user'),
            Rule::requiredIf(empty(request()->get('cnpj'))),
            new \App\Rules\CPFRule()
          ],
          'cnpj' => [
            Rule::unique('user')->ignore($this->user, 'id_user'),
            Rule::requiredIf(empty(request()->get('cpf'))),
            new \App\Rules\CNPJRule()
          ],
          'tipo' => Rule::in(['lojista', 'usuário', 'usuario']),
          'email' => [
            Rule::unique('user')->ignore($this->user, 'id_user'),
            'email'
          ],
          'saldo' => 'decimal:2'
        ];
    }
}
