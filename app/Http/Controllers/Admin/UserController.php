<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function index()
    {
        $users = User::where("type","user")->get();
        return view('admin.users.index',compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required',
            'phone'      => 'required|unique:users,phone',
            'email'      => 'required|email|unique:users,email',
            'password'      => 'required|min:8',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.users.create'))
                        ->withErrors($validator)
                        ->withInput();
        }
        User::create([
            'name'       => $request->name,
            'phone'      => $request->phone,
            'email'      => $request->email,
            "type"       => "user" ,
            "phone_veify"  => 1 ,
            "password" =>  Hash::make($request->password)
        ]);

        notify()->success('تم اضافة بنجاح');
        return redirect()->route('admin.users')->with(["success","تم اضافة بنجاح"]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit',compact('user'));
    }

    public function update(Request $request , $id)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required',
            'phone'      => 'required|unique:users,phone,'.$id,
            'email'      => 'required|email|unique:users,email,'.$id,
            'password'      => 'required|min:8',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.users.edit',$id))
                        ->withErrors($validator)
                        ->withInput();
        }

        if($request->has('password')){
            User::where('id',$id)
                ->update([
                    'password' => Hash::make($request->password),
                ]);
        }

        User::where('id', $id)->update([
            'name'       => $request->name,
            'phone'      => $request->phone,
            "phone_veify"  => 1 ,
            'email'      => $request->email,
        ]);

        notify()->success('تم تحديث بيانات بنجاح');
        return redirect()->route('admin.users')->with(["success","تم تحديث بيانات بنجاح"]);
    }
}
