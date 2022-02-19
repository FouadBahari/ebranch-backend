<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Cat;

class CatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cats = Cat::where('user_id',Auth::id())->get();
        return view('cats.index',compact('cats'));
    }

    public function create()
    {
        return view('cats.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'photo'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطأ في البيانات حاول مرة أخري');
            return redirect(route('vendor.cats.create'))
                        ->withErrors($validator)
                        ->withInput();
        }
        $filePath = '';
        if ($request->has('photo')) {
            $filePath = uploadImage('cats', $request->photo);
        }
        Cat::create([
            "name"      => $request->name ,
            'user_id'   => Auth::id() ,
            "photo"     => $filePath
        ]);
        notify()->success('تم بنجاح');
        return redirect()->route('vendor.cats')->with('success','تم بنجاح');
    }
    public function edit($id)
    {
        $cat = Cat::find($id);
        return view('cats.edit',compact('cat'));
    }
    public function update(Request $request , $id)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'photo'     => 'required_without:id|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطأ في البيانات حاول مرة أخري');
            return redirect(route('vendor.cats.edit',$id))
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($request->has('photo')) {
            $filePath = uploadImage('cats', $request->photo);
            Cat::find($id)->update([
                "photo"     => $filePath
            ]);
        }

        Cat::find($id)->update([
            "name"      => $request->name ,
        ]);
        notify()->success('تم بنجاح');
        return redirect()->route('vendor.cats')->with('success','تم بنجاح');
    }
}
