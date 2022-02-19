<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Card;
use Illuminate\Support\Facades\Validator;

class CardController extends Controller
{
    public function index()
    {
        $cards = Card::get();
        return view('admin.cards.index',compact('cards'));
    }

    public function create()
    {
        return view('admin.cards.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code'     => 'required',
            'price'    => 'required',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.cards.create'))
                        ->withErrors($validator)
                        ->withInput();
        }

        Card::create($request->all());

        notify()->success('تم اضافة بنجاح');
        return redirect()->route('admin.cards')->with(["success","تم اضافة بنجاح"]);
    }

    public function edit($id)
    {
        $coupon = Card::find($id);
        return view('admin.cards.edit',compact('coupon'));
    }

    public function update(Request $request , $id)
    {
        $validator = Validator::make($request->all(), [
            'code'     => 'required',
            'price'    => 'required',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.cards.edit',$id))
                        ->withErrors($validator)
                        ->withInput();
        }
        Card::where('id', $id)->update($request->all());

        notify()->success('تم تحديث بيانات بنجاح');
        return redirect()->route('admin.cards')->with(["success","تم تحديث بيانات بنجاح"]);
    }
}
