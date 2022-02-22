<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::get();
        return view('admin.banners.index',compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.banners.create'))
                        ->withErrors($validator)
                        ->withInput();
        }
        $filePath = '';
        if ($request->has('photo')) {
            $filePath = uploadImage('banners', $request->photo);
        }

        Banner::create([
            'photo'     => $filePath ,
        ]);

        notify()->success('تم اضافة بنجاح');
        return redirect()->route('admin.banners')->with(["success","تم اضافة بنجاح"]);
    }


    public function edit($id)
    {
        $banner = Banner::find($id);
        return view('admin.banners.edit',compact('banner'));
    }

    public function update(Request $request , $id)
    {
        $validator = Validator::make($request->all(), [
            'photo'     => 'required_without:id|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.banners.edit',$id))
                        ->withErrors($validator)
                        ->withInput();
        }
        if ($request->has('photo')) {
            $filePath = uploadImage('banners', $request->photo);
            Banner::find($id)->update([
                "photo"     => $filePath
            ]);
        }
        notify()->success('تم تحديث بيانات بنجاح');
        return redirect()->route('admin.banners')->with(["success","تم تحديث بيانات بنجاح"]);
    }
}
