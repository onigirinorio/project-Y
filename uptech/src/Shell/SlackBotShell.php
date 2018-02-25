<?php
namespace App\Shell;

use Cake\Console\ConsoleOptionParser;
use Cake\ORM\TableRegistry;
use Cake\Console\Shell;
use Cake\Log\Log;

use App\Controller\SlackBotController;

class SlackBotShell extends Shell
{

  public function initialize(){
    parent::initialize();
    $this->Slack = new SlackBotController();
  }

  public function main(){
    /*
     * クエリでshiftsテーブルにworksをJOINし、workの値がNULLの場合
     * 勤怠未登録とし、slackに通知をPOSTする。
    **/
    $message = NULL;
    $date = date('Y-m-d');

    $this->out("勤怠クーロン処理開始");

    $shifts = TableRegistry::get('Shifts');
    $query = $shifts->find()
    ->hydrate(false)
    ->join([
      'table' => 'works',
      'alias' => 'w',
      'type' => 'LEFT',
      'conditions' => 'w.user_id = Shifts.user_id AND w.create_at > Shifts.date',
    ])
    ->join([
      'table' => 'users',
      'alias' => 'u',
      'type' => 'LEFT',
      'conditions' => 'u.id = shifts.user_id',
    ])
    ->select([
      'id' => 'Shifts.id',
      'user_id' => 'Shifts.user_id',
      'attend' => 'w.attend_time',
      'name' => 'u.name',
    ])
    ->where(['date =' => $date]);

    // 出力
    foreach($query as $item) {
      if ($item['attend'] == NULL) {
        $message .= $item['name']."の出勤が確認できません。\n";
      }
    }

    // POSTデータ無い場合未処理
    if (!empty($message)) {
        $this->Slack->PostSlack($message);
    } else {
      $this->out("未出勤者はいません。");
    }
    $this->out("勤怠クーロン処理終了");
  }
}
