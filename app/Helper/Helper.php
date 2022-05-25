<?php

namespace App\Helper;

class Helper
{
    static function SendSMS(array $arr)
    {
        $url="http://sms.hitechsms.com/app/smsapi/index.php?key=".env('SMS_KEY')."&campaign=0&routeid=26&type=text&contacts=".$arr['phone']."&senderid=".env('SMS_SENDER_ID')."&msg=".urlencode($arr['text']);
        return file_get_contents($url);
    }
}


?>