<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoomFormRequest extends FormRequest
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
        $ruleArr =  [
            'room_no' => [
                'required',
                Rule::unique('rooms')->ignore($this->id)
            ],
            'floor' => 'required|numeric',
            'price' => 'required|numeric'
        ];
        if($this->id == null){
            $ruleArr['uploadfile'] = 'required|mimes:jpg,bmp,png,jpeg';
        }else{
            $ruleArr['uploadfile'] = 'mimes:jpg,bmp,png,jpeg';
        }
        return $ruleArr;
    }

    public function messages(){
        return [
            'room_no.required' => 'Hãy nhập phòng',
            'room_no.unique' => 'Tên phòng đã tồn tại',
            'floor.required' => 'Hãy nhập số tầng',
            'floor.numeric' => 'Số tâng không đúng định dạng',
            'price.required' => 'Hãy nhập giá phòng',
            'price.numeric' => 'Giá phòng không đúng định dạng',
            'uploadfile.required' => 'Hãy chọn ảnh phòng',
            'uploadfile.mimes' => 'File ảnh sản phẩm không đúng định dạng (jpg, bmp, png, jpeg)',
        ];
    }
}
