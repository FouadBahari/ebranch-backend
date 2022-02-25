<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($type)
    {
        $page = '';
        $status = '';
        if($type == "new"){
            $page = "طلبات الجديدة";
            $status = "جديد";
        }elseif($type == "vendoraccept"){
            $page = "طلبات الموافقة";
            $status = "تم الموافقة من المتجر";
        }elseif($type == "donereceve"){
            $page = "طلبات تم التوصيل";
            $status = "تم التوصيل";
        }elseif($type == "cancel"){
            $page = "طلبات ملغاة";
            $status = "الطلب ملغي";
        }else{
            return redirect(route('home'));
        }
        $all = Order::where('status',$status)->get();
        $orders = [];
        foreach($all as $order){
            $count = Product::whereIn('id',explode(',',$order->product_id))->where('user_id',Auth::id())->count();
            if($count > 0){
                $orders[] = $order;
            }
        }
        return view('orders.index',compact(['page','orders']));
    }

    public function status($status , $id)
    {
        $order = Order::find($id);
        if($order){
            notify()->error('هذا الاوردر غير موجود');
            return redirect()->back();
        }
        $type = "";
        if($status == "accept"){
            $type = "تم الموافقة من المتجر";
        }elseif($status == "cancel"){
            $type = "الطلب ملغي";
        }
        $order->update([
            'status' => $type
        ]);
        notify()->success('تم بنجاح');
        return redirect()->back();
    }
}
