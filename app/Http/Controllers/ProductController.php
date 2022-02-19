<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\Cat;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::where('user_id',Auth::id())->get();
        return view('products.index',compact('products'));
    }

    public function create()
    {
        $cats = Cat::get();
        return view('products.create',compact('cats'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required',
            'price'        => 'required',
            'amount'       => 'required',
            'description'  => 'required',
            'cat'          => 'required',
            'photo'        => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطأ في البيانات حاول مرة أخري');
            return redirect(route('vendor.products.create'))
                        ->withErrors($validator)
                        ->withInput();
        }
        $filePath = '';
        if ($request->has('photo')) {
            $filePath = uploadImage('products', $request->photo);
        }
        Product::create([
            "name"         => $request->name ,
            "price"        => $request->price ,
            "amount"       => $request->amount ,
            'offer'        => $request->offer ,
            'description'  => $request->description ,
            'user_id'      => Auth::id() ,
            "photo"        => $filePath ,
            'cat_id'       => $request->cat ,
            'colors'       => implode(',' , $request->colors) ,
            'sizes'        => implode(',' , $request->size) ,
        ]);
        notify()->success('تم بنجاح');
        return redirect()->route('vendor.products')->with('success','تم بنجاح');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $cats = Cat::get();
        return view('products.edit',compact(['cats','product']));
    }

    public function update(Request $request , $id)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required',
            'price'        => 'required',
            'amount'       => 'required',
            'description'  => 'required',
            'cat'          => 'required',
            'photo'        => 'required_without:id|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطأ في البيانات حاول مرة أخري');
            return redirect(route('vendor.products.edit',$id))
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($request->has('photo')) {
            $filePath = uploadImage('products', $request->photo);
            Product::find($id)->update([
                "photo"     => $filePath
            ]);
        }

        Product::find($id)->update([
            "name"         => $request->name ,
            "price"        => $request->price ,
            "amount"       => $request->amount ,
            'offer'        => $request->offer ,
            'description'  => $request->description ,
            'cat_id'       => $request->cat ,
            'colors'       => implode(',' , $request->colors) ,
            'sizes'        => implode(',' , $request->size) ,
        ]);
        notify()->success('تم بنجاح');
        return redirect()->route('vendor.products')->with('success','تم بنجاح');
    }
}
