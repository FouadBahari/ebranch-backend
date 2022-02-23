<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\User;
use App\Models\Order;
use App\Models\Notification;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    use GeneralTrait;

    public function __construct() {
        $this->middleware('auth:api');
    }

    public function makeorder(Request $request)
    {
        $rules = [
            'product_id'  => 'required',
            'amount'      => 'required',
            'type'        => 'required|in:home,driver,charger',
            'price'       => 'required',
            'address'     => 'required' ,
            'lat'         =>  'required' ,
            'lang'        =>  'required' ,

        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }
        $coupon = Coupon::where('code',$request->coupon)->first();
        if(!$coupon){
            return $this -> returnError('001','هذا الكود غير صحيح');
        }
        //$drivers = User::where('type','driver')->whereNotNull('wallet')->where('wallet','!=',0)->get();
        $vendor = Product::whereIn('id',explode(',',$request->product_id))->first()->user;
        sendmessage($vendor->token,'new order send to you','open app to accept order');
        $order = Order::create([
            'product_id'  => $request->product_id,
            'amount'      => $request->amount,
            'price'       => $coupon ? ($request->price * ($coupon->percent/100)) : $request->price,
            'user_id'     => Auth::id(),
            'address'     => $request->address,
            'lat'         => $request->lat,
            'lang'        => $request->lang,
            'status'      => 'جديد' ,
            'type'        => $request->type,
        ]);
        if($order){
            $user = User::find(Auth::id());
            $products = explode(',',$request->product_id);
            $user->products()->detach($products);
        }
        return $this->returnSuccessMessage('تم ارسال  الطلب بنجاح');
    }

    public function currentorders()
    {
        $orders = Order::whereNotIn('status',['الطلب ملغي' , 'الطلب متعثر' , 'الطلب مرتجع' , 'مخالصة'])->get();
        foreach($orders as $order){
            $order->products = Product::whereIn('id',explode(',',$order->product_id))->with('user')->get();
        }
        return $this -> returnData('data' , $orders,'تمت العملية بنجاح');
    }
    public function oldorders()
    {
        $orders = Order::whereIn('status',['الطلب ملغي' ,'الطلب منتهي' , 'مخالصة'])->get();
        foreach($orders as $order){
            $order->products = Product::whereIn('id',explode(',',$order->product_id))->with('user')->get();
        }
        return $this -> returnData('data' , $orders,'تمت العملية بنجاح');
    }

    public function cancelorder($id)
    {
        $order = Order::find($id);
        if(!$order){
            return $this -> returnError('001','الاوردر غير موجود');
        }
        $order->update([
            'status'   => 'الطلب ملغي'
        ]);
        return $this->returnSuccessMessage('تم الغاء الطلب بنجاح');
    }

    public function finishorder(Request $request)
    {
        $rules = [
            'orderid'     => 'required',
            'rate'        => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }
        $order = Order::find($request->orderid);
        if(!$order){
            return $this -> returnError('001','الاوردر غير موجود');
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
        if($type == "online"){
            $orders = Order::where('status','تم الموافقة من المتجر')->where('type','driver')->with('user')->get();
            foreach($orders as $order){
                $order->products = Product::whereIn('id',explode(',',$order->product_id))->with('user')->get();
            }
            return $this -> returnData('data' , $orders,'تمت العملية بنجاح');
        }elseif($type == "onproccess"){
            $orders = Order::where('status','تم الموافقة من السائق')->where('type','driver')
            ->where('driver_id',Auth::id())->with('user')->get();
            foreach($orders as $order){
                $order->products = Product::whereIn('id',explode(',',$order->product_id))->with('user')->get();
            }
            return $this -> returnData('data' , $orders,'تمت العملية بنجاح');
        }elseif($type == "receved"){
            $orders = Order::where('status','تم التوصيل')->where('type','driver')
            ->where('driver_id',Auth::id())->with('user')->get();
            foreach($orders as $order){
                $order->products = Product::whereIn('id',explode(',',$order->product_id))->with('user')->get();
            }
            return $this -> returnData('data' , $orders,'تمت العملية بنجاح');
        }elseif($type == "back"){
            $orders = Order::where('status','الطلب مرتجع')->where('type','driver')
            ->where('driver_id',Auth::id())->with('user')->get();
            foreach($orders as $order){
                $order->products = Product::whereIn('id',explode(',',$order->product_id))->with('user')->get();
            }
            return $this -> returnData('data' , $orders,'تمت العملية بنجاح');
        }elseif($type == "debug"){
            $orders = Order::where('status','الطلب متعثر')->where('type','driver')
            ->where('driver_id',Auth::id())->with('user')->get();
            foreach($orders as $order){
                $order->products = Product::whereIn('id',explode(',',$order->product_id))->with('user')->get();
            }
            return $this -> returnData('data' , $orders,'تمت العملية بنجاح');
        }
    }

    public function replayorder(Request $request)
    {
        $rules = [
            'orderid'     => 'required',
            'status'      => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }
        $status = '';
        if($request->status == "accept"){
            $status = "تم الموافقة من السائق";
        }elseif($request->status == "done"){
            $status = "تم التوصيل";
        }elseif($request->status == "back"){
            $status = "الطلب مرتجع";
        }elseif($request->status == "debug"){
            $status = "الطلب متعثر";
        }
        $order = Order::find($request->orderid);
        if(!$order){
            return $this -> returnError('001','الاوردر غير موجود');
        }
        $order->update([
            'status'   => $status,
            'replay'   => $request->reason,
        ]);
        return $this->returnSuccessMessage('تم بنجاح');
    }
}
