<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    { 
        return [
            'name'=>'required',
            'email'=>'required|email|unique:users,email,' . $this->user, 
            'password'=>'required',
            'birthday'=>'before:now',
            'phone' => 'numeric',
            'ava' => 'image',
            'gender'=> 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Không được để trống',
            'email.required' => 'Không được để trống',
            'email.email' => 'Phải là email',
            'email.unique' => 'Email đã bị trùng',
            'gender.required' => 'Không được để trống',
            'password.required' => 'Không được để trống',
            'phone.required' => 'Không được để trống',
            'phone.numeric' => 'Yêu cầu nhập số',
            'ava.image' => 'Phải là hình ảnh',
            'birthday.before' => 'Phải là thời gian trong quá khứ'
        ];
    }
}
