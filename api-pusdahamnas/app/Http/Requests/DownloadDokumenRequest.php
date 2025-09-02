<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class DownloadDokumenRequest extends FormRequest
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
            'username' => 'required',
            'email'    => 'required',
            'tujuan'   => 'required'
        ];
    }

    public function messages()
    {
        return [
            'username.required'         => 'username is required',
            'email.required'            => 'email is required',
            'tujuan.required'           => 'tujuan is required',
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

