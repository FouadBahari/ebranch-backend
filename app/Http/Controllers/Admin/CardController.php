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
    public function updateStatus(Request $request,$item)
    {

      
         $card = Card::find($item);
         if($request->status=="on"){
        $card->update(['status' => 1]);
         }else {
            $card->update(['status' => 0]); 
         }

    
        return redirect()->route('admin.cards')->with('success', 'Status updated successfully.');
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

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'price'    => 'required',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.cards.edit',$id))
                        ->withErrors($validator)
                        ->withInput();
        }
        $card=Card::find($request->id);



        if($card){
        $card->price=$request->price;
        $card->update();


        notify()->success('تم تحديث بيانات بنجاح');
        return redirect()->route('admin.cards')->with(["success","تم تحديث بيانات بنجاح"]);

        }
  else{
        return redirect()->route('admin.cards')->with(["error","حطا في التجديث" ]);
  }
    }
}
