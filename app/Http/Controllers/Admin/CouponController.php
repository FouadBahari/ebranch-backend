<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::get();
        return view('admin.coupons.index',compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupons.create');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code'       => 'required',
            'percent'    => 'required',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.coupons.create'))
                        ->withErrors($validator)
                        ->withInput();
        }

        Coupon::create($request->all());

        notify()->success('تم اضافة بنجاح');
        return redirect()->route('admin.coupons')->with(["success","تم اضافة بنجاح"]);
    }

    public function edit($id)
    {
        $coupon = Coupon::find($id);
        return view('admin.coupons.edit',compact('coupon'));
    }

    public function update(Request $request , $id)
    {
        $validator = Validator::make($request->all(), [
            'code'       => 'required',
            'percent'    => 'required',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.coupons.edit',$id))
                        ->withErrors($validator)
                        ->withInput();
        }
        Coupon::where('id', $id)->update($request->all());

        notify()->success('تم تحديث بيانات بنجاح');
        return redirect()->route('admin.coupons')->with(["success","تم تحديث بيانات بنجاح"]);
    }
}
