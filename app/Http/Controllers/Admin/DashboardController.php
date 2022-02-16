<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function editprofile()
    {
        return view('admin.editprofile');

    }

    public function updateprofile($id , Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:admins,name,'.$request -> id,
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required|email|unique:admins,email,'.$request -> id,
        ],[
            "photo.max"                    =>  'حجم الصورة كبيرا جدا اختر صورة حجمهااقل' ,
            "photo.image"                  =>  'عقوا هذة ليست صورة برجاء اختيار صورة' ,
            "name.unique"                  =>  'هذا الاسم موجود من قبل',
            "email.unique"                 =>  'هذا الايميل موجود من قبل' ,
            "email.required"                 =>  'لايمكن ترك الايميل فارغ' ,
            "name.required"                 =>  'لايمكن ترك الاسم فارغ'
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.editprofile'))
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($request->has('photo')) {
            $filePath = uploadImage('Admin', $request->photo);
        }

        if ($request->has('password')) {
            $password = $request->password;
        }

        Admin::where('id',$id)->update([
            "name"      => $request->name ,
            "email"     => $request->email,
            "photo"     => isset($filePath) ? $filePath : Auth::user()->photo,
            "password"  => isset($password) ? bcrypt($password)  : Auth::user()->password ,
        ]);
        notify()->success('تم تحديث الملف الشخصي بنجاح');
        return redirect()->route('admin.editprofile')->with('success','تم تحديث الملف الشخصي بنجاح');
    }


    public function logout()
    {
        Auth::logout();
        return  redirect()->route('admin.login');
    }

    public function sendmessages(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'   => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.editprofile'))
            ->withErrors($validator)
            ->withInput();
        }
        $users    = User::get();

        /////////////////////////////////////////////////
        if($request->type == 'all'){
            foreach($users as $user){
                sendmessage($user->token,$request->title,$request->content);
            }

            notify()->success('تم الارسال بنجاح');
            return redirect()->back();
        /////////////////////////////////////////////////
        }elseif($request->type == 'users'){
            foreach($users as $user){
                sendmessage($user->token,$request->title,$request->content);
            }
            notify()->success('تم الارسال بنجاح');
            return redirect()->back();
        /////////////////////////////////////////////////
        }

    }

}
