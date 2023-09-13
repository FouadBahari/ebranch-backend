<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\User;
use App\Models\Order;

use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\GeneralTrait;
use App\Helpers\Notifications;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    use GeneralTrait;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function makeorder(Request $request)
    {
        //      $rules = [
        //     'product_id'  => 'required',
        //     'amount'      => 'required',
        //     'type'        => 'required|in:home,driver,charger',
        //     'price'       => 'required',
        //     'address'     => 'required' ,
        //     'lat'         =>  'required' ,
        //     'lang'        =>  'required' ,

        // ];

        // $validator = Validator::make($request->all(), $rules);

        // if ($validator->fails()) {
        //     $code = $this->returnCodeAccordingToInput($validator);
        //     return $this->returnValidationError($code, $validator);
        // }

        $coupon = Coupon::where('code', $request->coupon)->first();

        if ($coupon) {

            $price = $request->price * ($coupon->percent / 100);
        } else {
            $price = $request->price;
        }





        // if(!$coupon){
        //     return $this -> returnError('001','هذا الكود غير صحيح');
        // }
        //$drivers = User::where('type','driver')->whereNotNull('wallet')->where('wallet','!=',0)->get();
        // $vendor = Product::whereIn('id',explode(',',$request->product_id))->first()->user;
        // sendmessage($vendor->token,'new order send to you','open app to accept order');
        $order = Order::create([
            'product_id'  => $request->product_id,
            'amount'      => $request->amount,
            'price'       => $price,
            'user_id'     => Auth::id(),
            'address'     => $request->address,
            'lat'         => $request->lat,
            'lang'        => $request->lang,
            'status'      => 'جديد',
            'type'        => $request->type,
            'color'       => $request->color,
            'size'        => $request->size,
            'shipping_price' => $request->shipping_price,
            'vendor_id' => $request->vendor_id,
            'vendor_name' => $request->vendor_name,
            'vendor_phone' => $request->vendor_phone,
            'vendor_address' => $request->vendor_address,
            'vendor_lang' => $request->vendor_lang,
            'vendor_lat' => $request->vendor_lat,
            'username' => $request->username,
            'userphone' => $request->userphone,
        ]);
        if ($order) {
            $user = User::find(Auth::id());
            $products = explode(',', $request->product_id);
            $user->products()->detach($products);
        }
        return $this->returnSuccessMessage('تم ارسال  الطلب بنجاح');
    }

    public function currentorders()
    {
        $user = User::find(Auth::id());
        $orders = Order::where('user_id', $user->id)->whereNotIn('status', ['الطلب ملغي', 'الطلب متعثر', 'الطلب مرتجع', 'مخالصة'])->get();
        foreach ($orders as $order) {
            $order->products = Product::whereIn('id', explode(',', $order->product_id))->with('user')->get();
        }
        return $this->returnData('data', $orders, 'تمت العملية بنجاح');
    }
    public function oldorders()
    {
        $user = User::find(Auth::id());
        $orders = Order::where('user_id', $user->id)->whereIn('status', ['الطلب ملغي', 'الطلب منتهي', 'مخالصة','تم التوصيل'])->get();
        foreach ($orders as $order) {
            $order->products = Product::whereIn('id', explode(',', $order->product_id))->with('user')->get();
        }
        return $this->returnData('data', $orders, 'تمت العملية بنجاح');
    }

    public function cancelorder($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return $this->returnError('001', 'الاوردر غير موجود');
        }
        $order->update([
            'status'   => 'الطلب ملغي'
        ]);
        return $this->returnSuccessMessage('تم الغاء الطلب بنجاح');
    }

    public function finishorder(Request $request)
    {
        // $rules = [
        //     'orderid'     => 'required',
        //     'rate'        => 'required',
        // ];

        // $validator = Validator::make($request->all(), $rules);

        // if ($validator->fails()) {
        //     $code = $this->returnCodeAccordingToInput($validator);
        //     return $this->returnValidationError($code, $validator);
        // }
        $order = Order::find($request->orderid);
        if (!$order) {
            return $this->returnError('001', 'الاوردر غير موجود');
        }
        $order->update([
            'status'   => "الطلب منتهي",
            'rate'   => $request->rate,
            'replay'   => $request->replay,
        ]);
        return $this->returnSuccessMessage('تم بنجاح');
    }

    public function ordersdriver($type)
    {

        
        if ($type == "online") {
            $orders = Order::where('status', 'تم الموافقة من المتجر')->where('type', 'driver')->with('user')->get();
            foreach ($orders as $order) {
                $order->products = Product::whereIn('id', explode(',', $order->product_id))->with('user')->get();
             
            }
            return $this->returnData('data', $orders, 'تمت العملية بنجاح');
        } elseif ($type == "onproccess") {
            $orders = Order::where('status', 'تم الموافقة من السائق')->orWhere('status','تم الاستلام من المتجر')->where('type', 'driver')
                ->where('driver_id', Auth::id())->with('user')->get();
            foreach ($orders as $order) {
                $order->products = Product::whereIn('id', explode(',', $order->product_id))->with('user')->get();
            }
            return $this->returnData('data', $orders, 'تمت العملية بنجاح');
        } elseif ($type == "receved") {
            $orders = Order::where('status', 'تم التوصيل')->where('type', 'driver')
                ->where('driver_id', Auth::id())->with('user')->get();
            foreach ($orders as $order) {
                $order->products = Product::whereIn('id', explode(',', $order->product_id))->with('user')->get();
            }
            return $this->returnData('data', $orders, 'تمت العملية بنجاح');
        } elseif ($type == "back") {
            $orders = Order::where('status', 'الطلب مرتجع')->where('type', 'driver')
                ->where('driver_id', Auth::id())->with('user')->get();
            foreach ($orders as $order) {
                $order->products = Product::whereIn('id', explode(',', $order->product_id))->with('user')->get();
            }
            return $this->returnData('data', $orders, 'تمت العملية بنجاح');
        } elseif ($type == "debug") {
            $orders = Order::where('status', 'الطلب متعثر')->where('type', 'driver')
                ->where('driver_id', Auth::id())->with('user')->get();
            foreach ($orders as $order) {
                $order->products = Product::whereIn('id', explode(',', $order->product_id))->with('user')->get();
            }
            return $this->returnData('data', $orders, 'تمت العملية بنجاح');
        }
    }

    public function replayorder(Request $request)
    {
        $rules = [
            'orderid'     => 'required',
            'status'      => 'required',
        ];
        $title="تنبيه";
        $ordre=Order::find($request->orderid);
        $user=User::find($ordre->user_id);

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }
        $driver = User::find(Auth::id());
        $status = '';
        if ($request->status == "accept") {
            $status = "تم الموافقة من السائق";
          Notifications::sendmessage($user->token, $title,$status);
          
   $body=$status;
          Notification::create([
            'order_id'  => $request->orderid,
            'user_id'      => $ordre->user_id,
            'title'       => $title,
            'body'       => $body,

        ]);



        } elseif ($request->status == "done") {
            $status = "تم التوصيل";
            $driver=User::find(Auth::id());
            $admin_comision=Admin::first();
            if ($driver && $admin_comision) {
                $new_wallet = $driver->wallet-$admin_comision->site_precent;
                $driver->wallet=$new_wallet;

                
                $old_orderscounter=$driver->countorders;
                $new_orderscounter =$old_orderscounter+1;

                $driver->countorders=$new_orderscounter;
                $earningOrder=($ordre->shipping_price-$admin_comision->site_precent);
                $old_gain=$driver->gain;
                $driver->gain=$old_gain+$earningOrder;
                
                $driver->update(); // Save the updated User model
            }

            Notifications::sendmessage($user->token, $title,$status);
            $body=$status;
            Notification::create([
              'order_id'  => $request->orderid,
              'user_id'      => $ordre->user_id,
              'title'       => $title,
              'body'       => $body,
  
          ]);


        } elseif ($request->status == "donevendor") {
            $status = "تم الاستلام من المتجر";
            Notifications::sendmessage($user->token, $title,$status);
            $body=$status;
            Notification::create([
              'order_id'  => $request->orderid,
              'user_id'      => $ordre->user_id,
              'title'       => $title,
              'body'       => $body,
  
          ]);


        } elseif ($request->status == "back") {
            $status = "الطلب مرتجع";
            Notifications::sendmessage($user->token, $title,$status);
            $body=$status;
            Notification::create([
              'order_id'  => $request->orderid,
              'user_id'      => $ordre->user_id,
              'title'       => $title,
              'body'       => $body,
  
          ]);

        } elseif ($request->status == "debug") {
            $status = "الطلب متعثر";
            Notifications::sendmessage($user->token, $title,$status);
               $body=$status;
          Notification::create([
            'order_id'  => $request->orderid,
            'user_id'      => $ordre->user_id,
            'title'       => $title,
            'body'       => $body,

        ]);

        }
        $order = Order::find($request->orderid);
        if (!$order) {
            return $this->returnError('001', 'الاوردر غير موجود');
        }
        // if($driver->wallet == 0){
        //      return $this -> returnError('001','المحفظة فارغة برجاء الشجن والمحاولة لاحفا');
        // }
        $order->update([
            'status'   => $status,
            'replay'   => $request->reason,
            'driver_id'   => $driver->id,
        ]);
        //$drive->decrement('wallet',1);
        return $this->returnSuccessMessage('تم بنجاح');
    }

}