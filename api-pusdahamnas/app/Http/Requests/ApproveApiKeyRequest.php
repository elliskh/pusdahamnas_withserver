<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class ApproveApiKeyRequest extends FormRequest 
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
            'username' => 'required|max:50',
            'email' => 'required|email',
            'apikey_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Username is required',
            'email.required' => 'Email is required',
            'apikey_id.required' => 'Apikey_id is required',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation($validator)
    {
        $response = new JsonResponse([
            'message' => $validator->errors(),
            'error' => true,
            'code' => 400
        ], 400);

        throw new HttpResponseException($response);
    }
}
