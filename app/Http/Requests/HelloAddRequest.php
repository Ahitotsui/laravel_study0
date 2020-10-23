<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//自分で考えて作ってみた

class HelloAddRequest extends FormRequest
{
    public function authorize()
    {
        if ($this->path() == 'hello/add')
        {
            return true;
        } else{
            return false;
        }
        
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'mail' => 'email',
            'age' => 'numeric|between:0,150',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '必須です',
            'mail.email' => 'emailで入力',
            'age.numeric' => '数字です',
            'age.between' => '範囲:0〜150',
        ];
    }
}
