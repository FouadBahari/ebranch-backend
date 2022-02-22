<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reason;
use Illuminate\Support\Facades\Validator;

class ReasonController extends Controller
{
    public function index()
    {
        $reasons = Reason::get();
        return view('admin.settings.reasons.index',compact('reasons'));
    }

    public function create()
    {
        return view('admin.settings.reasons.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type'     => 'required',
            'name'    => 'required',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.reasons.create'))
                        ->withErrors($validator)
                        ->withInput();
        }

        Reason::create($request->all());

        notify()->success('تم اضافة بنجاح');
        return redirect()->route('admin.reasons')->with(["success","تم اضافة بنجاح"]);
    }

    public function edit($id)
    {
        $reason = Reason::find($id);
        return view('admin.settings.reasons.edit',compact('reason'));
    }

    public function update(Request $request , $id)
    {
        $validator = Validator::make($request->all(), [
            'type'     => 'required',
            'name'     => 'required',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.reasons.edit',$id))
                        ->withErrors($validator)
                        ->withInput();
        }
        Reason::where('id', $id)->update([
            'type'   => $request->type ,
            'name'   => $request->name ,
        ]);

        notify()->success('تم تحديث بيانات بنجاح');
        return redirect()->route('admin.reasons')->with(["success","تم تحديث بيانات بنجاح"]);
    }
}
