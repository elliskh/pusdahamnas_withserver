<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class LoginRequest extends FormRequest
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
            'username' => 'required|min:6',
            'password' => 'required|min:8',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Email / Username is required',
            'password.required' => 'password is required',
        ];
    }

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
