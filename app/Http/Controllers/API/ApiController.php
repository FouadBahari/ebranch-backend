<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use Twilio\Rest\Client;
use App\Models\Cat;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use App\Models\Reason;
use App\Models\Service;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    use GeneralTrait;

    public function services()
    {
        $services = Service::get();
        return  $this -> returnData('services' , $services,'Done Get services');
    }

    public function allvendors()
    {
        $allvendors = User::where('type','vendor')->get();
        return  $this -> returnData('vendors' , $allvendors,'Done Get allvendors');
    }

    public function searchvendors($name)
    {
  
       $vendors = User::where('type','vendor')->where('name','like',"%$name%")->get();

        return  $this -> returnData('vendors' , $vendors,'Done Get vendors');
    }



    public function vendors($idservice)
    {
        $vendors = User::where('type','vendor')->where('service_id',$idservice)->get();
        return  $this -> returnData('vendors',$vendors,'Done Get vendors');
    }

    public function categories($vendor)
    {
        $cats = Cat::where('user_id',$vendor)->get();
        return  $this -> returnData('services' , $cats,'Done Get services');
    }


    public function offers($vendor)
    {
        $offers = Product::where('user_id',$vendor)->where('offer','!=',0)->whereNotNull('offer')->with('cat')->get();
        return  $this -> returnData('data' , $offers,'Done Get offers');
    }

    public function bestselles($vendor)
    {
        $bestselles = Product::where('user_id',$vendor)->with('cat')->get();
        return  $this -> returnData('data' , $bestselles,'Done Get bestselles');
    }

    public function products()
    {
        $products = Product::inRandomOrder()->with('cat')->get();
        return  $this -> returnData('data' , $products,'Done Get products');
    }

    public function productsvendor($cat)
    {
        $products = Product::where('cat_id',$cat)->with('cat')->get();
        return  $this -> returnData('data' , $products,'Done Get products');
    }

    public function contactus(Request $request)
    {
        $rules = [
            'name'      => 'required|string|max:255',
            'email'     => 'required|email',
            // 'subject'   => 'required' ,
            'messages'  => 'required' ,
        ];

        $validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }
        $contact = Contact::create($request->all());

        if(!$contact)
            return $this -> returnError('001','Error Send Contact');

            return $this->returnSuccessMessage('تم الارسال بنجاح');
        }

    public function sliders($id)
    {
        // $sliders = Banner::inRandomOrder()->limit(5)->get();
        // $sliders = Banner::where("user_id",$id)->inRandomOrder()->limit(5)->get();
        $sliders = Banner::inRandomOrder()->limit(5)->get();

      
        return  $this -> returnData('data' , $sliders,'Done Get sliders');
    }

    public function reasons($type)
    {
        $reasons = Reason::where('type',$type)->get();
        return  $this -> returnData('data' , $reasons,'Done Get reasons');
    }
    public function get_settings()
    {
        $admin = Admin::find(1);
        return  $this -> returnData('data' , $admin,'Done Get Admins settings');
    }

    public function logins(Request $request)
    {
        try {
            $rules = [
                "phone"     => "required",
                "password"  => "required" ,
                'token'     => "required"

            ];

            $validator = Validator::make($request->all(), $rules  ,[
                'phone.required' => 'حقل رقم الهاتف مطلوب' ,
                'password.required' => 'حقل كلمة السر مطلوب' ,
        ]);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            //login
            $credentials = $request->only(['phone','password']) ;
            if(Auth::guard('api')->attempt($credentials)){
                $user = Auth::guard('api')->user();
                User::find($user->id)->update(['token' => $request->token]);
                $user-> api_token = Auth::guard('api')->attempt($credentials);
                if($user->status == 0){
                    return $this->returnError('E001','بانتظار التفعيل من الادمن');
                }
                return $this -> returnData('data' , $user,'Login successfully');

            }else{
                return $this->returnError('E001','بيانات الدخول غير صحيحة');
            }

        }catch (\Exception $ex){
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }



    // public function forgetpass(Request $request)
    // {
    //     $user = User::where('phone',$request->phone)->first();
    //     if(!$user){
    //         return $this->returnError('E001','رقم الهاتف غير صحيح');
    //     }
    //     $phone = '+2'.$request->phone;
    //     $token = getenv("TWILIO_AUTH_TOKEN");
    //     $twilio_sid = getenv("TWILIO_SID");
    //     $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
    //     $twilio = new Client($twilio_sid, $token);
    //     $twilio->verify->v2->services($twilio_verify_sid)
    //         ->verifications
    //         ->create($phone, "sms");
    //    return $this->returnSuccessMessage('تم بنجاح');
    // }

    // public function verifyforgetpass(Request $request)
    // {
    //     $code  = $request->code ;

    //       /* Get credentials from .env */
    //     $phone = "+2".$request->phone;
    //     $token = getenv("TWILIO_AUTH_TOKEN");
    //     $twilio_sid = getenv("TWILIO_SID");
    //     $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
    //     $twilio = new Client($twilio_sid, $token);
    //     $verification = $twilio->verify->v2->services($twilio_verify_sid)
    //         ->verificationChecks
    //         ->create($code, array('to' => $phone));
    //     if ($verification->valid) {
    //         return $this->returnSuccessMessage('تم بنجاح');
    //     }else{
    //         return $this -> returnError('001','الكود غير صحيح');
    //     }
    // }

    // public function restpass(Request $request)
    // {
    //     $phone    = $request->phone;
    //     $password = $request->password;
    //     $rules = [
    //         'phone'        => 'required',
    //         'password'     => 'required|confirmed',
    //     ];

    //     $validator = Validator::make($request->all(), $rules);

    //     if ($validator->fails()) {
    //         $code = $this->returnCodeAccordingToInput($validator);
    //         return $this->returnValidationError($code, $validator);
    //     }

    //     $user = User::where('phone',$request->phone)->first();

    //     $user->update([
    //         'password'  => Hash::make($password),
    //     ]);

    //     $credentials = $request -> only(['phone','password']) ;
    //     $token =  Auth::guard('api')->attempt($credentials);
    //     $user -> api_token = $token;

    //     return $this -> returnData('data' , $user,'تمت العملية بنجاح');

    // }
}
