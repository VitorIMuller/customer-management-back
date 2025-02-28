<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomer extends FormRequest
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
            'name'         => 'nullable|string',
            'email'        => 'nullable|email|unique:customers,email',
            'phone'        => 'nullable|string',
            'cellphone'    => 'nullable|string',
            'status'       => 'nullable|in:A,I',
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
            'email.unique' => 'O e-mail informado já está em uso.',
        ];
    }
}
