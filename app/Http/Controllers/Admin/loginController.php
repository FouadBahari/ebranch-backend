<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function getLogin()
    {
        return view('admin.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $remember_me = $request->has('remember_me') ? true : false;
        $password= $request->input('password');

        if (Auth::guard('admin')->attempt(['email' => $request->input('email') , 'password'=> $password] , $remember_me)) {
            notify()->success('تم الدخول بنجاح  ');
            return redirect()->route('admin.dashboard');
        }
        notify()->error('خطا في البيانات  برجاء المجاولة مجدا ');
        return redirect()->route('admin.login')->with(['error' => 'هناك خطا بالبيانات']);
    }
}
