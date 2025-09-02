<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException; 
use Illuminate\Http\JsonResponse;

class RegisterRequest extends FormRequest
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
            // Ellis: change users_mobile to users
            'username'          => 'required|max:50|unique:users,username',
            'email'             => 'required|email|max:255|unique:users,email',
            'password'          => 'required|min:8',
            // 'pendidikan'        => 'required',
            'name'              => 'required',
            'lembaga_instansi'  => 'required',
            'tipe_daftar'       => 'required',
        ];
    }

    public function messages()
    {
        return [
            'username.required'         => 'Username is required',
            'name.required'             => 'Name is required',
            'email.required'            => 'Email is required', 
            'email.email'               => 'Email must be a valid email address',
            'password.required'         => 'password is required',
            // 'pendidikan.required'       => 'Pendidikan is required',
            'lembaga_instansi.required' => 'Lembaga_instansi is required',
            'tipe_daftar'               => 'Tipe_daftar is required',
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
