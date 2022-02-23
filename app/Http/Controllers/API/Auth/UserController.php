<?php

namespace App\Http\Controllers\API\Auth;
use App\User;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\Order;
use App\Models\OrderCard;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use GeneralTrait;

    public function __construct() {
        $this->middleware('auth:api', ['except' => ['signup']]);
    }

    public function signup(Request $request)
    {
        $rules = [
            'name'      => 'required|string|max:255',
            'email'     => 'required|unique:users',
            'phone'     => 'required|unique:users',
            'password'  => 'required|string|min:8',
            'address'   => 'required' ,
            'type'      =>  'required' ,
            'token'     =>  'required' ,

        ];

        $validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }

        $filepath = [];
        if($request->has('photo'))
        {
            foreach(explode(',',$request->photo) as $photo){
                $filepath[] = uploadImage('users', $photo);
            }

        }

            $user = User::create([
                'name'      => $request->name,
                'phone'     => $request->phone,
                'email'     => $request->email,
                'photo'     => implode(',',$filepath),
                'password'  => Hash::make($request->password),
                'address'   => $request->address ,
                'lat'       => $request->lat ,
                'lang'      => $request->lang ,
                'type'      => $request->type ,
                'status'    => $request->type == 'user' ? 1 : 0 ,
                'token'     => $request->token
            ]);

        if(!$user)
            return $this -> returnError('001','Error created User');

        $credentials = $request -> only(['phone','password']) ;
        $token =  Auth::guard('api')->attempt($credentials);
        $user -> api_token = $token;

        return $this -> returnData('data' , $user,'تمت العملية بنجاح');
    }


    public function editprofile(Request $request)
    {
        $rules = [
            'name'      => 'required|string|max:255',
            'photo'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }

        if($request->has('password'))
        {
            User::where('id',Auth::id())->update([
                'password' => Hash::make($request->password),
            ]);
        }

        if($request->has('photo'))
        {
            $path = uploadImage('users', $request->photo);
            User::where('id',Auth::id())->update([
                'photo' => $path,
            ]);
        }

        User::where('id',Auth::id())->update([
            'name'    => $request->name,
        ]);

        return $this->returnSuccessMessage('تم تحديث البروفايل بنجاح');
    }

    public function dataedituser()
    {
        $user = User::find(Auth::id());
        return $this -> returnData('data' , $user,'تمت العملية بنجاح');
    }

    public function addtocart($product)
    {
        $user   = User::find(Auth::id());
        $vendor = Product::find($product)->user_id;
        $vendors = 0 ;
        $ids = [];
        foreach($user->products as $pro){
            $vendors = $pro->user_id;
            $ids[]     = $pro->id;
        }
        if(in_array($product , $ids)){
            return $this -> returnError('001','المنتج موجود في السلة من قبل');
        }
        if($vendors == 0){
            $user->products()->attach([$product]);
            return $this->returnSuccessMessage('تم الاضافة الي السلة بنجاح');
        }
        if($vendor ==  $vendors){
            $user->products()->attach([$product]);
            return $this->returnSuccessMessage('تم الاضافة الي السلة بنجاح');
        }else{
            return $this -> returnError('001','برجاء افراغ السلة من منتجات المتاجر الاخري');
        }
        return $this->returnSuccessMessage('تم الاضافة الي السلة بنجاح');
    }

    public function removetocart($product)
    {
        $user   = User::find(Auth::id());
        $products = [$product];
        $user->products()->detach($products);
        return $this->returnSuccessMessage('تم الازالة من السلة بنجاح');
    }

    public function allincart()
    {
        $user = User::find(Auth::id());
        $products = $user->products;
        return $this -> returnData('data' , $products,'تمت العملية بنجاح');
    }

    public function chargecard($code)
    {
        $card  = Card::where('code',$code)->first();
        $order = OrderCard::where('user_id')->first();
        if(!$card){
            return $this -> returnError('001','هذا الكود غير صحيح');
        }
        if($order){
            return $this -> returnError('001','لقد قمت بشحن الكارت من قبل');
        }
        User::find(Auth::id())->increment('wallet',$card->price);
        OrderCard::create([
            'user_id'   => Auth::id() ,
            'card_id'   => $card->id ,
        ]);
        return $this->returnSuccessMessage('تم الشحن بنجاح');
    }

    public function orderschargecard()
    {
        $orders = OrderCard::where('user_id',Auth::id())->with(['card'])->get();
        return $this -> returnData('data' , $orders,'تمت العملية بنجاح');
    }

    public function notifications()
    {
        $notifications = Notification::where('user_id',Auth::id())->with(['user','order'])->get();
        return $this -> returnData('data' , $notifications,'تمت العملية بنجاح');
    }
}
