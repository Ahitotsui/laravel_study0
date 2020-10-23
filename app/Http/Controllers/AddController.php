<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

//-------------------------------------
//|レコード追加の際のバリデーション機能を追加できないか実験。
//|このコントローラは、自分で考えて作った。
//|本では特に作成指示されてないものである。
//|
//|2020/10/21

class AddController extends Controller
{
    public function post(Request $request)
    {
        $validate_rule = [
            'name' => 'required',
            'mail' => 'email',
            'age' => 'numeric|between:0,150',
        ];
        $this->validate($request,$validate_rule);
        //return view('hello.index');
    }
}
