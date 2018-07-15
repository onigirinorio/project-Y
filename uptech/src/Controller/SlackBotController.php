<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;


class SlackBotController extends AppController
{
    public function PostSlack($text)
    {

        $msg = array(
            'username' => ALERT_SLACK['bot_name'],
            'text' => "<!channel> \n" . $text,
            'icon_emoji' => ALERT_SLACK['bot_icon'],
            'channel' => ALERT_SLACK['channel'],
        );

        $msg = json_encode($msg);
        $msg = 'payload=' . urlencode($msg);


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, ALERT_SLACK['webhook_url']);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $msg);
        curl_exec($ch);
        curl_close($ch);
    }
}
