<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductPutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Normally we would have a logic here to do authorization
        // and authentication here. But for now, we can
        // make it open.
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
            'name' => 'required|alpha_num',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ];
    }

    /**
     * Handles a passed validation to transform validated fields
     */
    public function validatedTransformed()
    {
        return $this->safe()->merge([
            'quantity' => intval($this->quantity),
            'price' =>  number_format(floatval($this->price), 2),
        ]);
    }

    /**
     * Handles a failed validation attempt by returning a JSON error object,
     * instead of using the default redirection logic.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
