<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomer extends FormRequest
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
            'name'         => 'required|string',
            'email'        => 'required|email|unique:customers,email',
            'phone'        => 'required|string|unique:customers,phone',
            'cellphone'    => 'required|string|unique:customers,cellphone',
            'status'       => 'required|in:A,I',
            'zipcode'      => 'nullable|string',
            'address'      => 'nullable|string',
            'number'       => 'nullable|string',
            'complement'   => 'nullable|string',
            'neighborhood' => 'nullable|string',
            'city'         => 'nullable|string',
            'state'        => 'nullable|string',
            'country'      => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'      => 'O campo nome é obrigatório.',
            'email.required'     => 'O campo e-mail é obrigatório.',
            'email.email'        => 'O campo e-mail deve ser um e-mail válido.',
            'email.unique'       => 'O e-mail informado já está em uso.',
            'phone.required'     => 'O campo telefone é obrigatório.',
            'cellphone.required' => 'O campo celular é obrigatório.',
        ];
    }
}
