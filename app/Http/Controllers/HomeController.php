<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Plan;
use App\Models\Withdraw;
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
            'password'  => 'required|min:8|confirmed',
            'photo'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'id_define' => 'required|numeric|unique:users,id_define,'.$request->id,
        ],[
            "photo.max"                 =>  'حجم الصورة كبيرا جدا اختر صورة حجمهااقل' ,
            "photo.image"               =>  'عقوا هذة ليست صورة برجاء اختيار صورة' ,
            "name.unique"               =>  'هذا الاسم موجود من قبل' ,
            "name.required"             =>  'لايمكن ترك الاسم فارغ'   ,
            // "photo.required"            =>  'حقل الصورة مطلوب'      ,
            // "id_define.required"        =>  'حقل رقم البطاقة مطلوب' ,
            "password.required"         =>  'كلمة السر مطلوبة'      ,
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
            "id_define" => $request->id_define,
        ]);
        notify()->success('تم تحديث الملف الشخصي بنجاح');
        return redirect()->route('home')->with('success','تم تحديث الملف الشخصي بنجاح');
    }

    public function withdrawmoney(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname'      => 'required',
            'bank_number'  => 'required',
            'bank_name'     => 'required'
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطأ في البيانات حاول مرة أخري');
            return redirect(route('home'))
                        ->withErrors($validator)
                        ->withInput();
        }

        $withdraw = Withdraw::where('user_id',Auth::id())->whereDate('created_at',date('Y-m-d'))->orwhere('status','pending')->fist();
        if($withdraw){
            notify()->warning('نأسف لعدم ارسال الطلب ربما يكون هناك طلب مسبق لم يوافق علية او قمت بعمل سحب اليوم');
            return redirect()->route('home');
        }

        if ($request->has('photos')) {
            $validator = Validator::make($request->all(), [
                'photos'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($validator->fails()) {
                notify()->error('حدث خطأ في البيانات حاول مرة أخري');
                return redirect(route('home'))
                            ->withErrors($validator)
                            ->withInput();
            }
            $filePath = uploadImage('users', $request->photos);
            User::find(Auth::id())->update([
                "photo"     => $filePath
            ]);
        }

        if ($request->has('id_defines')) {
            $validator = Validator::make($request->all(), [
                'id_defines' => 'required|numeric|unique:users,id_define,'.Auth::id(),
            ]);

            if ($validator->fails()) {
                notify()->error('حدث خطأ في البيانات حاول مرة أخري');
                return redirect(route('home'))
                            ->withErrors($validator)
                            ->withInput();
            }
            User::find(Auth::id())->update([
                "id_define" => $request->id_defines,
            ]);
        }

        Withdraw::create([
            "user_id"       => Auth::id() ,
            "amount"        => Auth::user()->coins ,
            "status"        => "pending" ,
            "bank_number"   => $request->bank_number ,
            "bank_name"     => $request->bank_name ,
        ]);
        notify()->success('تم ارسال الطلب بنجاح');
        return redirect()->route('home')->with('success','تم ارسال الطلب بنجاح');
    }
}
