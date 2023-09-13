<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class OrderController extends Controller
{
    public function index($type)
    {
        $page = '';
        $status = '';
        if($type == "new"){
            $page = "طلبات الجديدة";
            $status = "جديد";
        }elseif($type == "vendoraccept"){
            $page = "طلبات الموافقة من المتجر";
            $status = "تم الموافقة من المتجر";
        }elseif($type == "driveraccept"){
            $page = "طلبات تحت التنفيذ";
            $status = "تم الموافقة من السائق";
        }elseif($type == "donereceve"){
            $page = "طلبات تم التوصيل";
            $status = "تم التوصيل";
        }elseif($type == "debug"){
            $page = "طلبات متعثر";
            $status = "الطلب متعثر";
        }elseif($type == "back"){
            $page = "طلبات مرتجع";
            $status = "الطلب مرتجع";
        }elseif($type == "cancel"){
            $page = "طلبات ملغاة";
            $status = "الطلب ملغي";
        }elseif($type == "finish"){
            $page = "طلبات منتهي";
            $status = "الطلب منتهي";
        }elseif($type == "finished"){
            $page = "طلبات خالص";
            $status = "مخالصة";
        }else{
            return redirect(route('admin.dashboard'));
        }
        $orders = Order::where('status',$status)->get();
        foreach($orders as $order){
            $order->products = Product::whereIn('id',explode(',',$order->product_id))->with('user')->get();
        }
        return view('admin.orders.index',compact(['orders','page']));
    }

    
    public function order_charger ($type)
    {


            $page = '';
            $status = '';
            if($type == "new"){
                $page = "طلبات الجديدة";
                $status = "جديد";
            }elseif($type == "vendoraccept"){
                $page = "طلبات الموافقة من المتجر";
                $status = "تم الموافقة من المتجر";
            }elseif($type == "driveraccept"){
                $page = "طلبات تحت التنفيذ";
                $status = "تم الموافقة من السائق";
            }elseif($type == "donereceve"){
                $page = "طلبات تم التوصيل";
                $status = "تم التوصيل";
            }elseif($type == "debug"){
                $page = "طلبات متعثر";
                $status = "الطلب متعثر";
            }elseif($type == "back"){
                $page = "طلبات مرتجع";
                $status = "الطلب مرتجع";
            }elseif($type == "cancel"){
                $page = "طلبات ملغاة";
                $status = "الطلب ملغي";
            }elseif($type == "finish"){
                $page = "طلبات منتهي";
                $status = "الطلب منتهي";
            }elseif($type == "finished"){
                $page = "طلبات خالص";
                $status = "مخالصة";
            }else{
                return redirect(route('admin.dashboard'));
            }
   
  
        $orders = Order::where('type', 'charger')->where('status',$status)->get();

        foreach($orders as $order){
            $order->products = Product::whereIn('id',explode(',',$order->product_id))->with('user')->get();
        }
      


        return view('admin.chargers_orders.index', compact(['orders', 'page']));
    }

    public function status($status , $id)
    {
        $order = Order::find($id);
        if(!$order){
            notify()->error('هذا الاوردر غير موجود');
            return redirect()->back();
        }
        $type = "";
        if($status == "vendoraccept"){
            $type = "تم الموافقة من المتجر";
        }elseif($status == "driveraccept"){
            $type = "تم الموافقة من السائق";
        }elseif($status == "donereceve"){
            $type = "تم التوصيل";
        }elseif($status == "debug"){
            $type = "الطلب متعثر";
        }elseif($status == "back"){
            $type = "الطلب مرتجع";
        }elseif($status == "cancel"){
            $type = "الطلب ملغي";
        }elseif($status == "finish"){
            $type = "الطلب منتهي";
        }elseif($status == "finished"){
            $type = "مخالصة";
        }else{
            return redirect(route('admin.dashboard'));
        }
        $order->update([
            'status' => $type
        ]);
        notify()->success('تم بنجاح');
        return redirect()->back();
    }
    
    public function invoice(Request $request)
    {
        try {
            // Debugging statement to check if the method is reached
            \Log::info('Invoice controller method reached.');
    
            $order = Order::findOrFail($request->order_id);
    
            $data = [
                'order' => $order,
                'message' => 'hello', // Include the message in the data array
            ];
    
            return view('admin.orders.invoicePrinter.invoice', $data);
        } catch (ModelNotFoundException $e) {
            // Handle the case where the order with the provided ID is not found
            return response()->json(['error' => 'not works'], 601);
        }
    }

    
}
