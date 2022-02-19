<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function updateprofile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'password'  => 'required|min:8',
            'photo'     => 'required_without:id|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email'     => 'required|email|unique:users,email,'.$request->id,
            'phone'     => 'required|unique:users,phone,'.$request->id,
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطأ في البيانات حاول مرة أخري');
            return redirect(route('home'))
                        ->withErrors($validator)
                        ->withInput();
        }


        if ($request->has('photo')) {
            $filePath = uploadImage('users', $request->photo);
            User::find(Auth::id())->update([
                "photo"     => $filePath
            ]);
        }

        if ($request->has('password')) {
            User::find(Auth::id())->update([
                "password"  => bcrypt($request->password)
            ]);
        }

        User::find(Auth::id())->update([
            "name"      => $request->name ,
            "email"     => $request->email,
            "phone"     => $request->phone,
        ]);
        notify()->success('تم تحديث الملف الشخصي بنجاح');
        return redirect()->route('home')->with('success','تم تحديث الملف الشخصي بنجاح');
    }
}
