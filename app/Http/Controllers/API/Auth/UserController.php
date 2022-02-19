<?php

namespace App\Http\Controllers\API\Auth;
use App\User;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\Order;
use App\Models\OrderNet;
use App\Models\OrderGift;
use App\Models\Gift;
use App\Models\Casher;
use App\Models\Suggestion;
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
            'photo'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
                'status'    => $request->type ,
                'type'      => $request->type == 'user' ? 1 : 0 ,
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
        return $this -> returnData('user' , $user,'تمت العملية بنجاح');
    }
}
