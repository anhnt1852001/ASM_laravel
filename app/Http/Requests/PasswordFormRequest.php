<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PasswordFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required',
            'new-password' => 'required|min:6|confirmed',
        ];
    }
    public function messages()
    {
        return [
            'password.required' => 'Hãy nhập mật khẩu',
            'new-password.required' => 'Hãy nhập mật khẩu mới',
            'new-password.min' => 'Mật khẩu mới thối thiểu 6 ký tự',
            'new-password.confirmed' => 'Xác nhận mật khẩu chưa khớp'
        ];
    }
}
