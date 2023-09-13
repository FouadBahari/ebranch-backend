<?php

use Illuminate\Support\Facades\Config;

function get_default_lang(){
    return   Config::get('app.locale');
}


function uploadImage($folder, $image)
{
    //$image->store( $folder);
    $filename = $image->hashName();
    $path2 = base_path("images/".$folder);
    $image->move($path2,$filename);
    $path = 'images/' . $folder . '/' . $filename;
    return $path;
}

    function sendmessage( $token, $title , $body)
    {


        return "hello";
        $token = $token;
        $from = "AAAApppfRac:APA91bEBTETqHAR4ifYBoZ7ECCKHHNQ-PUaea5ACmFQ2WRG5m8H31XAyGSkOCkNF8FiaONGSwTfk-Hsmt-GI5WZ2f0nmuIqMCDCHzsNZdlMFdIKhvfYPTCNNUUVMfTrtb5mEXspPuPm3";
        $msg = array
            (
                'body'     => $body,
                'title'    => $title,
                'receiver' => 'erw',
                'icon'     => "https://two-tech.net/Frontend/ar/images/logos/logo-with-bg.png",/*Default Icon*/
                'vibrate'	=> 1,
	            'sound'		=> "http://commondatastorage.googleapis.com/codeskulptor-demos/DDR_assets/Kangaroo_MusiQue_-_The_Neverwritten_Role_Playing_Game.mp3",
            );

        $fields = array
                (
                    'to'        => $token,
                    'notification'  => $msg
                );

        $headers = array
                (
                    'Authorization: key=' . $from,
                    'Content-Type: application/json'
                );
        //#Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );
        return $result;
    }

