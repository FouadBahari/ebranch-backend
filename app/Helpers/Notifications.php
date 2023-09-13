<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Notifications
{

    public static function  sendmessage($token, $title , $body)
    {


        try {
            // Configuration settings should be read from Laravel configuration files or environment variables
            $serverKey = 'AAAAFh1S36c:APA91bHE0lpwRDBKDajqTgGZIeV-HHoByRcaiVmqF_kbxa_lplfF4FSzgEpYQLMmk79Sajs_msSTXZUtgNE7T7_wfIFvC4k-iKCZF_fDATo7OkCz6i0KwQAFeZNw6TpRF4s_74vII8zE';

            $message = [
                'body' => $body,
                'title' => $title,
                // Other notification data...
            ];

            $data = [
                'to' => $token,
                'notification' => $message,
            ];

            $headers = [
                'Authorization: key=' . $serverKey,
                'Content-Type: application/json',
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            $result = curl_exec($ch);

            // Handle the FCM response here and log accordingly

            curl_close($ch);

            return $result;
        } catch (\Exception $e) {
            // Handle exceptions and log errors
            Log::error('Notification sending failed: ' . $e->getMessage());
            return false; // Or throw the exception if needed
        }
    }
    }








