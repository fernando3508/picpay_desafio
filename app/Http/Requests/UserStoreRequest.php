<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserStoreRequest extends FormRequest
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
            'required',
            'max:255',
            new \App\Rules\NomeCompletoRule()
          ],
          'cpf' => [
            Rule::requiredIf(empty(request()->get('cnpj'))),
            new \App\Rules\CPFCNPJRule(),
            'unique:App\Models\User,cpf_cnpj'
          ],
          'cnpj' => [
            Rule::requiredIf(empty(request()->get('cpf'))),
            new \App\Rules\CPFCNPJRule(),
            'unique:App\Models\User,cpf_cnpj'
          ],
          'tipo' => [
            'required',
            Rule::in(['lojista', 'usuário', 'usuario'])
          ],
          'saldo' => 'decimal:2',
          'email' => [
            'required',
            'unique:App\Models\User,email',
            'email'
          ],
        ];
    }
}
