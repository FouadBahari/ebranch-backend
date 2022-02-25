<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function products()
    {
        $products = Product::get();
        return view('admin.product',compact('products'));
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

    public function chargers()
    {
        $admins = Admin::where('id','!=',1)->get();
        return view('admin.chargers.index',compact('admins'));
    }

    public function createchargers()
    {
        return view('admin.chargers.create');
    }

    public function storechargers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required',
            'phone'      => 'required|unique:admins,phone',
            'email'      => 'required|email|unique:admins,email',
            'password'   => 'required|min:8',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.chargers.create'))
                        ->withErrors($validator)
                        ->withInput();
        }
        Admin::create([
            'name'       => $request->name,
            'phone'      => $request->phone,
            'email'      => $request->email,
            'type'       => 'charger' ,
            "password"   =>  Hash::make($request->password)
        ]);

        notify()->success('تم اضافة بنجاح');
        return redirect()->route('admin.chargers')->with(["success","تم اضافة بنجاح"]);
    }

    public function editchargers($id)
    {
        $admin = Admin::find($id);
        return view('admin.chargers.edit',compact('admin'));
    }

    public function update(Request $request , $id)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required',
            'phone'      => 'required|unique:admins,phone,'.$id,
            'email'      => 'required|email|unique:admins,email,'.$id,
            'password'   => 'required|min:8',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.chargers.edit',$id))
                        ->withErrors($validator)
                        ->withInput();
        }
        if($request->has('password')){
            Admin::where('id',$id)
                ->update([
                    'password' => Hash::make($request->password),
                ]);
        }

        Admin::where('id', $id)->update([
            'name'       => $request->name,
            'phone'      => $request->phone,
            'email'      => $request->email,
        ]);

        notify()->success('تم تحديث بيانات بنجاح');
        return redirect()->route('admin.chargers')->with(["success","تم تحديث بيانات بنجاح"]);
    }

    public function settings()
    {
        $admin = Admin::find(1);
        return view('admin.settings.settings',compact('admin'));
    }
    public function updatesettings(Request $request)
    {
        notify()->success('تم تحديث بيانات بنجاح');
        return redirect()->route('admin.settings')->with(["success","تم تحديث بيانات بنجاح"]);
    }

}
