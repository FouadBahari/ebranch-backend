<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\User;
use Illuminate\Support\Facades\Log;
use App\Helpers\Notifications;
use App\Models\Product;
use App\Models\Notification;

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
        if ($type == "new") {
            $page = "طلبات الجديدة";
            $status = "جديد";
        } elseif ($type == "vendoraccept") {
            $page = "طلبات الموافقة";
            $status = "تم الموافقة من المتجر";
        } elseif ($type == "donereceve") {
            $page = "طلبات تم التوصيل";
            $status = "تم التوصيل";
        } elseif ($type == "cancel") {
            $page = "طلبات ملغاة";
            $status = "الطلب ملغي";
        } else {
            return redirect(route('home'));
        }
        $all = Order::where('status', $status)->get();
        $orders = [];
        foreach ($all as $order) {
            $count = Product::whereIn('id', explode(',', $order->product_id))->where('user_id', Auth::id())->count();
            if ($count > 0) {
                $orders[] = $order;
            }
        }
        return view('orders.index', compact(['page', 'orders']));
    }



    public function status($status, $id)
    {
        $order = Order::find($id);
        $token = User::find($order->user_id);
        $title = "تنبيه";

        if (!$order) {
            notify()->error('هذا الاوردر غير موجود');
            return redirect()->back();
        }
        $type = "";
        if ($status == "accept") {
            $type = "تم الموافقة من المتجر";
            Notifications::sendmessage($token->token, $title, $type);
            $body = $type;
            Notification::create([
                'order_id'  => $id,
                'user_id'      => $order->user_id,
                'title'       => $title,
                'body'       => $body,

            ]);

            $user = User::where('type', 'driver')->get();


            foreach ($user as $item) {
                if ($item->token) {
                    Notifications::sendmessage($item->token, $title, $type);
                }
            }
        } elseif ($status == "cancel") {
            $type = "الطلب ملغي";
            Notifications::sendmessage($token->token, $title, $type);

            $body = $type;
            Notification::create([
                'order_id'  => $id,
                'user_id'      => $order->user_id,
                'title'       => $title,
                'body'       => $body,

            ]);
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
