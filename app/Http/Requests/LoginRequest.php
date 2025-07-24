<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
            'username' => ['required', 'string'],
            'password' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Tên tài khoản là bắt buộc',
            'username.string' => 'Tên tài khoản không hợp lệ',
            'password.required' => 'Mật khẩu là bắt buộc',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $errors = [];

        foreach ($validator->errors()->messages() as $field => $messages) {
            $errors[$field] = $messages[0]; // Chỉ lấy thông báo đầu tiên
        }

        throw new HttpResponseException(response()->json([
            'message' => 'Dữ liệu không hợp lệ',
            'errors' => $errors
        ], 422));
    }
}
