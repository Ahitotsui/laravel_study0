<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\Response;

use App\Http\Requests\HelloRequest;

//validation
use App\Http\Requests\HelloAddRequest;

use Validator;

use Illuminate\Support\Facades\DB;

use App\Models\Person;

use Illuminate\Support\Facades\Auth;



// --------------------------------コントローラでテンプレートを使う(p.62)--------------------------------
class HelloController extends Controller{
    
    public function index(Request $request)
    {
        $user = Auth::user();
        $sort = $request->sort;
        // $items = Person::where('name',$user)->orderBy($sort, 'asc')->paginate(5);
        $items = Person::orderBy($sort, 'asc')->paginate(5);
        $param = ['items'=>$items , 'sort'=> $sort , 'user' => $user];
        return view('hello.index',$param);
    }
    
    public function post(Request $request)
    {
        $items = DB::select('select * from people');
        return view('hello.index',['items' => $items]);
    }



    //add
    public function add(Request $request)
    {
        return view('hello.add');
    }

    //add (validatioを実装にするためにRequest→HelloAddRequestに変更)
    public function create(HelloAddRequest $request)
    {
        //validation試しに追加→うまくできたけど、このやり方は非推奨らしい
        // $validate_rule = [
        //     'name' => 'required',
        //     'mail' => 'email',
        //     'age' => 'numeric|between:0,150',
        // ];
        // $this->validate($request,$validate_rule);

        $param = [
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        DB::table('people')->insert($param);
        return redirect('/hello');
    }

    //edit
    public function edit(Request $request)
    {
        $item = DB::table('people')
            ->where('id',$request->id)->first();
        return view('hello.edit',['form' => $item]);
    }

    //edit
    public function update(Request $request)
    {
        $param = [
            'id' => $request->id,
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        DB::table('people')
            ->where('id',$request->id)
            ->update($param);
        return redirect('/hello');
    }

    //delete
    public function del(Request $request)
    {
        $item = DB::table('people')
            ->where('id',$request->id)->first();
        return view('hello.del',['form' => $item]);
    }

    //delete
    public function remove(Request $request)
    {
        DB::table('people')
            ->where('id',$request->id)->delete();
        return redirect('/hello');
    }

    //show
    public function show(Request $request)
    {
        $id = $request->id;
        $item = DB::table('people')->where('id', $id)->first();
        return view('hello.show', ['item' => $item]);
    }

    //show2
    public function show2(Request $request)
    {
        $page = $request->page;
        $items = DB::table('people')
            ->offset($page * 3)
            ->limit(3)
            ->get();
        return view('hello.show2', ['items' => $items]);
    }

    public function rest(Request $request)
    {
        return view('hello.rest');
    }

    //session
    public function ses_get(Request $request)
    {
        $sesdata = $request->session()->get('msg');
        return view('hello.session',['session_data' => $sesdata]);
    }

    public function ses_put(Request $request)
    {
        $msg = $request->input;
        $request->session()->put('msg',$msg);
        return redirect('hello/session');
    }

    //login
    public function getAuth(Request $request)
    {
        $param = ['message' => 'plese login.'];
        return view('hello.auth',$param);
    }

    public function postAuth(Request $request)
    {
        $email = $request->email;
        $password =  $request->password;
        if (Auth::attempt(['email'=>$email,'password'=>$password])){
            $msg = 'You logined(' . Auth::user()->name . ')';
        } else {
            $msg = 'fail to login.';
        }
        return view('hello.auth',['message' => $msg]);
    }


}

