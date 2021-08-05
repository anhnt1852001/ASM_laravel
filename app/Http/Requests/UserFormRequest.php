<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserFormRequest extends FormRequest
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
            'name' =>
            [
                'required',
                Rule::unique('users')->ignore($this->id)
            ],
            'email'=>
            [
                'required',
                'email',
                Rule::unique('users')->ignore($this->id)
            ],
            'password'=> 'required|min:6',
            'phone_number'=>'required|min:10|numeric'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Hãy nhập tên KH',
            'name.unique' => 'Tên KH đã tồn tại',
            'email.required' => 'Hãy nhập email',
            'email.unique' => 'Email đã tồn tại',
            'email.email' => 'Sai định dạng email',
            'password.required' => 'Hãy nhập mật khẩu',
            'password.min' => 'Password tối thiểu 6 ký tự',
            'phone_number.required' => 'Hãy nhập SĐT',
            'phone_number.min' => 'SĐT tối thiểu 10 số',
            'phone_number.numeric' => 'Số điện thoại không đúng định dạng'
        ];
    }
}
