<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;


class SlackBotController extends AppController
{
  // ポスト先のチャンネル
  private $channel = '#alert_kintai';
  // ポストbot名称
  private $username = '勤怠アラートbot';
  // ポストbotのアイコン
  private $icon_emoji = ':nishino2:';
  // webhook 発行URL
  private $webhook_url = 'https://hooks.slack.com/services/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';

  public function PostSlack($text){

    $msg = array(
      'username' => $this->username,
      'text' => "<!channel> \n".$text,
      'icon_emoji' => $this->icon_emoji,
      'channel' => $this->channel,
    );

    $msg = json_encode($msg);
    var_dump($msg);
    $msg = 'payload=' . urlencode($msg);


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->webhook_url);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $msg);
    curl_exec($ch);
    curl_close($ch);
  }
}
