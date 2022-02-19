<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function index($type)
    {
        $nametype = '';
        if($type == "user"){
            $nametype  = "المستخدمين";
        }elseif($type == "vendor"){
            $nametype  = "التجار";
        }elseif($type == "driver"){
            $nametype  = "السائقين";
        }elseif($type == "charger"){
            $nametype  = "شركات الشحن";
        }else{
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect()->back();
        }
        $users = User::where("type",$type)->get();
        return view('admin.users.index',compact(['users','type','nametype']));
    }

    public function waitapprove()
    {
        $users = User::where('type','driver')->where("status",0)->get();
        return view('admin.users.wait',compact(['users']));
    }
    public function approved($id)
    {
        $user = User::find($id);
        $user->update([
            'status'   => 1
        ]);
        notify()->error('تم التفعيل بنجاح');
        return redirect()->back();
    }

    public function create($type)
    {
        $nametype = '';
        if($type == "user"){
            $nametype  = "المستخدمين";
        }elseif($type == "vendor"){
            $nametype  = "التجار";
        }elseif($type == "driver"){
            $nametype  = "السائقين";
        }elseif($type == "charger"){
            $nametype  = "شركات الشحن";
        }else{
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect()->back();
        }
        $services = Service::get();
        return view('admin.users.create',compact(['type','nametype','services']));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required',
            'phone'      => 'required|unique:users,phone',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|min:8',
            "address"    => 'required' ,
            "type"       => 'required' ,
            'photo'      => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.users.create',$request->type))
                        ->withErrors($validator)
                        ->withInput();
        }
        $filePath = '';
        if ($request->has('photo')) {
            $filePath = uploadImage('users', $request->photo);
        }
        User::create([
            'name'       => $request->name,
            'phone'      => $request->phone,
            'email'      => $request->email,
            "type"       => $request->type ,
            "address"    => $request->address ,
            "lat"        => $request->lat ,
            "lang"       => $request->lang ,
            "service_id" => $request->service_id ,
            'photo'      => $filePath ,
            "password"   =>  Hash::make($request->password)
        ]);

        notify()->success('تم اضافة بنجاح');
        return redirect()->route('admin.users',$request->type)->with(["success","تم اضافة بنجاح"]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        $nametype = '' ;
        if($user->type == "user"){
            $nametype  = "المستخدمين";
        }elseif($user->type == "vendor"){
            $nametype  = "التجار";
        }elseif($user->type == "driver"){
            $nametype  = "السائقين";
        }elseif($user->type == "charger"){
            $nametype  = "شركات الشحن";
        }else{
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect()->back();
        }
        $services = Service::get();
        return view('admin.users.edit',compact(['user','services','nametype']));
    }

    public function update(Request $request , $id)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required',
            'phone'      => 'required|unique:users,phone,'.$id,
            'email'      => 'required|email|unique:users,email,'.$id,
            'password'   => 'required|min:8',
            "address"    => 'required' ,
            "type"       => 'required' ,
            'photo'      => 'required_without:id|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.users.edit',$id))
                        ->withErrors($validator)
                        ->withInput();
        }
        if ($request->has('photo')) {
            $filePath = uploadImage('users', $request->photo);
            User::find($id)->update([
                "photo"     => $filePath
            ]);
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
            "type"       => $request->type ,
            "address"    => $request->address ,
            "service_id" => $request->service_id ,
            'email'      => $request->email,
        ]);

        notify()->success('تم تحديث بيانات بنجاح');
        return redirect()->route('admin.users',$request->type )->with(["success","تم تحديث بيانات بنجاح"]);
    }
}
