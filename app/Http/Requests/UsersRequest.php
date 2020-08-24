<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


use App\Enums\Gender;

use BenSampo\Enum\Rules\EnumValue;

class UsersRequest extends FormRequest
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
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'birthday'=>'before:now',
            'phone' => 'numeric',
            'avatar' => 'image',
            'gender'=> ['required', new EnumValue(Gender::class)]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Không được để trống',
            'email.required' => 'Không được để trống',
            'email.email' => 'Phải là email',
            'gender.required' => 'Không được để trống',
            'password.required' => 'Không được để trống',
            'phone.required' => 'Không được để trống',
            'phone.numeric' => 'Yêu cầu nhập số',
            'avatar.image' => 'Phải là hình ảnh',
            'birthday.before' => 'Phải là thời gian trong quá khứ'
        ];
    }
}