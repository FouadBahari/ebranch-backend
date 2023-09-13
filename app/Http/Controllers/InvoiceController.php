<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\User;


class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
  
$order=Order::find($request->order_id);
 $user=User::find($order->user_id);





 return view('admin.orders.invoicePrinter.invoice', compact('order','user'));
 

    }

    public function order_charger($type)
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
   
  
        $all = Order::where('type', 'charger')->where('status',$status)->get();
        $orders = [];
        foreach ($all as $order) {
            $count = Product::whereIn('id', explode(',', $order->product_id))->where('user_id', Auth::id())->count();
            if ($count > 0) {
                $orders[] = $order;
            }
        }
        return view('chargers_orders.index', compact(['page', 'orders']));
    }












    public function get_ip()
    {

        return "hello";
    }
    //   $ip = $request->ip; 

    //   $currentUserInfo = Location::get($ip);

    //     return $currentUserInfo;
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(country $country)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, country $country)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(country $country)
    {
        //
    }
}
