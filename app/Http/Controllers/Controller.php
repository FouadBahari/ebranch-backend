<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Alert;
use Stevebauman\Location\Facades\Location;
//use Twilio\Rest\Client;
use App\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function addnews(Request $request)
    {
        $messages = [
            'email.required' => 'هذا الحقل مطلوب',
            'email.unique' => 'عفوا هذا الايميل قام بالاشترك من قبل',
        ];
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:newsletters|email',
        ],$messages);

        if ($validator->fails()) {
    $error = $validator->errors()->getMessages()['email'][0];
        return response()->json([
            'status' => 'error',
            'msg' => $error,
        ]);
        }

        $subscribe = new Newsletter();
        $subscribe->email= $request->email;
        $subscribe->save();

        $details = [
            'title' => 'تم اشتراكك في تشرتنا البريدية',
            'body' => 'شكرا لاشتراكك معنا يسعدنا دائما وجودكم معنا سيصلكم كل ما هو جديد لدينا وأفضل العروض والاخبار الهامة لدينا'
        ];
        Mail::to($request->email)->send(new \App\Mail\contactus($details));

        return response()->json([
            'status' => 'success',
            'msg' => '!!شكرا لك لاشتراكك معنا سوف يصلك كل ماهو جديد',
        ]);
    }

    public function sendmessage(Request $request)
    {
        $messages = [
            'email.required' => 'هذا الحقل مطلوب',
            'email.email' => 'هذا الايميل غير صالح',
        ];
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ],$messages);

        if ($validator->fails()) {
            $error = $validator->errors()->getMessages()['email'][0];
            return response()->json([
                'status' => 'error',
                'msg' => $error,
            ]);
        }

        $details = [
            'title' => 'شكرا لتواصلك معنا',
            'body' => 'شكرا لك علي تواصلك معنا سيتم الرد علي سيادتكم في أسرع وقت. دائما متواجدون من أجلكم'
        ];
        Mail::to($request->email)->send(new \App\Mail\contactus($details));

        $detailsme = [
            'title' => $request->msg_subject,
            'body' => "Name :".$request->name." | Email : ".$request->email." | Phone :".$request->phone_number." | Message :".$request->message
        ];
        Mail::to("ahmedgamal012064@gmail.com")->send(new \App\Mail\contactus($detailsme));

        return response()->json([
            'status' => 'success',
            'msg' => 'شكرا لتواصلك معنا سيتم الرد عليك في أقرب وقت',
        ]);
    }

    public function devicetokenguest(Request $request)
    {
        $alert = Alert::where('token',$request->token)->first();
        $ip   = request()->ip();
        $Info = Location::get($ip);
        if(!$alert){
        Alert::create([
            'token'     =>   $request->token ,
            'ip'        => $ip ,
            'countery'  => $Info->countryName,
            'region'    => $Info->regionName,
            'lat'       => $Info->latitude,
            'lang'      => $Info->longitude,
        ]);
        return 'done';
        }else{
            Alert::find($alert->id)->update([
                'token'    =>   $request->token ,
                'ip'        => $ip ,
                'countery'  => $Info->countryName,
                'region'    => $Info->regionName,
                'lat'       => $Info->latitude,
                'lang'      => $Info->longitude,
            ]);
            return 'done';
        }
    }

}
