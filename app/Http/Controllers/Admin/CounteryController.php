<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Countery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouponsController extends Controller
{
    public function index()
    {
        $counteries = Countery::get();
        return view('admin.counteries.index',compact('counteries'));
    }

    public function create()
    {
        return view('admin.counteries.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code'       => 'required',
            'name'    => 'required',
            'photo'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.counteries.create'))
                        ->withErrors($validator)
                        ->withInput();
        }
   	$filePath = '';
        if ($request->has('photo')) {
            $filePath = uploadImage('counteries', $request->photo);
        }
        Countery::create([
		'code'   => $request->code ,
		'name'   => $request->name ,
		'photo'  => $filePath ,
        ]);

        notify()->success('تم اضافة بنجاح');
        return redirect()->route('admin.counteries')->with(["success","تم اضافة بنجاح"]);
    }

    public function edit($id)
    {
        $countery = Countery::find($id);
        return view('admin.coupons.edit',compact('countery'));
    }

    public function update(Request $request , $id)
    {
        $validator = Validator::make($request->all(), [
            'code'      => 'required',
            'name'      => 'required',
            'photo'     => 'required_without:id|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.counteries.edit',$id))
                        ->withErrors($validator)
                        ->withInput();
        }
         if ($request->has('photo')) {
            $filePath = uploadImage('counteries', $request->photo);
            Countery::find($id)->update([
                "photo"     => $filePath
            ]);
        }
        Countery::where('id', $id)->update([
          'code'   => $request->code ,
          'name'   => $request->name ,
        ]);

        notify()->success('تم تحديث بيانات بنجاح');
        return redirect()->route('admin.counteries')->with(["success","تم تحديث بيانات بنجاح"]);
    }
}
