<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use PHPExcel_IOFactory;
/**
 * Works Controller
 *
 * @property \App\Model\Table\WorksTable $Works
 *
 * @method \App\Model\Entity\Work[] paginate($object = null, array $settings = [])
 */
class WorksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        // ユーザーのセレクトボックス用のデータを取得
        $select_users = $this->Works->getSelectUsers();

        // 検索処理
        $query = $this->Works->makeQueryGetParameter($this->request->getQuery());

        $this->paginate = array(
            'contain' => array('Users', 'Projects'),
            'conditions' => array('Works.delete_flg = 0'),
            'limit' => 35,
        );

        $works = $this->paginate($query);
        $this->set(compact('select_users'));
        $this->set(compact('works'));
        $this->set('_serialize', ['works']);
    }

    /**
     * View method
     *
     * @param string|null $id Work id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $work = $this->Works->get($id, [
            'contain' => ['Users', 'Projects']
        ]);

        $this->set('work', $work);
        $this->set('_serialize', ['work']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Users = TableRegistry::get('Users');
        $this->Shifts = TableRegistry::get('Shifts');
        $user = $this->Users->get($this->Auth->user('id'));

        $work = $this->Works->newEntity();
        if ($this->request->is('post')) {
            $work = $this->Works->patchEntity($work, $this->request->getData());
            //作成日時
            $work->create_at = date('Y-m-d H:i:s');
            //休憩時間は登録時は固定で1時間とする。
            $work->break_time = '1:00';
            //残業時間をデフォルトで0に
            $work->overtime = '0:00';
            // 登録する勤怠の日付のシフトを取得、シフトがなければ出勤登録させない
            $shift = $this->Shifts->find()->where(['date' => date('Y-m-d', strtotime($work->create_at))])->first();
            if ($shift == null) {
                $this->Flash->error(__('本日はシフト登録されていません。'));
                return $this->redirect(['action' => 'add']);
            }
            //出勤時間(遅刻した場合のみ現在時刻で打刻)
            $work->attend_time = date('H:i');
            if (strtotime($work->attend_time) <= strtotime($shift->attend)) {
                $work->attend_time = $shift->attend;
            }

            // 既に出勤が登録されていたら保存しない
            $latest_work = $this->Works->find()
                ->where(['user_id' => $this->Auth->user('id')])
                ->order(['create_at' => 'DESC'])
                ->first();
            if (!empty($latest_work) &&date('Y-m-d', strtotime($latest_work->create_at)) == date('Y-m-d')) {
                $this->Flash->error(__('既に出勤が登録されています。'));
                return $this->redirect(['action' => 'add']);
            }

            if ($this->Works->save($work)) {
                $this->Flash->success(__('出勤を登録しました。'));
                return $this->redirect(['action' => 'add']);
            }

            $this->Flash->error(__('予期せぬエラーが発生しました、もう一度お試しください。'));
        }

        $project = $user->project_id;

        $this->set(compact('work', 'project'));
        $this->set('_serialize', ['work']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Work id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
//        $work = $this->Works->get($id, [
//            'contain' => []
//        ]);
//        if ($this->request->is(['patch', 'post', 'put'])) {
//            $work = $this->Works->patchEntity($work, $this->request->getData());
//            if ($this->Works->save($work)) {
//                $this->Flash->success(__('The work has been saved.'));
//
//                return $this->redirect(['action' => 'index']);
//            }
//            $this->Flash->error(__('The work could not be saved. Please, try again.'));
//        }
//        $users = $this->Works->Users->find('list', ['limit' => 200]);
//        $projects = $this->Works->Projects->find('list', ['limit' => 200]);
//        $this->set(compact('work', 'users', 'projects'));
//        $this->set('_serialize', ['work']);
    }

    public function addLeave()
    {
        $work = $this->Works->find()
            ->where(['user_id' => $this->Auth->user('id')])
            ->order(['create_at' => 'DESC'])
            ->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $work = $this->Works->patchEntity($work, $this->request->getData());
            //$work->leave_time = date('H:i');
            $work->leave_time = '19:15';
            $attend = strtotime($work->attend_time);
            $leave = strtotime($work->leave_time);
            $break = strtotime($work->break_time);
            $work['overtime'] = $this->Works->calc_overtime($attend, $leave, $break);
            if ($this->Works->save($work)) {
                $this->Flash->success(__('退勤が登録されました。'));
                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('退勤の登録に失敗しました。'));
            return $this->redirect(['action' => 'add']);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Work id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $work = $this->Works->get($id);

        //削除フラグに1を代入
        $work->delete_flg = 1;

        if ($this->Works->save($work)) {
            $this->Flash->success(__('勤怠を削除しました。'));
        } else {
            $this->Flash->error(__('予期せぬエラーが発生しました。'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Excel出力用
     */
    public function downloadExcel()
    {
        $data = $this->request->getData();
        $this->Users = TableRegistry::get('Users');
        $user = $this->Users->get($data['user_id']);

        // 勤怠データ取得
        $works = $this->Works->find()
            ->where(
                    [
                        'Works.user_id' => $data['user_id'],
                        'YEAR(create_at)' => $data['date_y'],
                        'MONTH(create_at)' => $data['date_m']
                    ]
                )
            ->all()
            ->toArray();

        // 入出力の情報設定
        $driPath    = realpath(WWW_ROOT) . "/excel/";
        $inputPath  = $driPath . "template.xls";
        $sheetName  = "Sheet1";
        $outputFile = $user['name'] . "_" . $data['date_y']. "_" . $data['date_m'] . ".xls";

        // Excalファイル作成
        $reader = PHPExcel_IOFactory::createReader('Excel5');
        $book   = $reader->load($inputPath);
        $sheet  = $book->getSheetByName($sheetName);

        // ユーザー名記入
        $sheet->setCellValue('V1', $user['name']);
        // 日付記入
        $sheet->setCellValue('A1', $data['date_y']);
        $sheet->setCellValue('G1', ltrim($data['date_m'], "0"));

        // 稼働データ記入
        for ($i = 0; $i < 31; $i++) {
            $work = null;
            foreach ($works as $key => $value) {
                if (date('j', strtotime($value['create_at'])) == ($i + 1)) {
                    $work = $value;
                }
            }
            if (isset($work)) {
                // excel用にTimeオブジェクトをフォーマットするカラムをセット
                $columns = ['attend_time', 'leave_time', 'break_time', 'overtime'];
                //excel用にTimeオブジェクトをフォーマットする
                $times = $this->format_time_to_excel($work, $columns);

                $rowNum = 4 + $i;
                $sheet->setCellValue('E' . $rowNum, $times['attend_time']);
                $sheet->setCellValue('J' . $rowNum, $times['leave_time']);
                $sheet->setCellValue('O' . $rowNum, $times['break_time']);
                $sheet->setCellValue('Y' . $rowNum, $times['overtime']);
            }
        }

        // ダウンロード
        header('Content-Type: application/force-download');
        header('Content-Disposition: attachment;filename="' . $outputFile . '"');
        header('Cache-Control: max-age=0');
        $book->setActiveSheetIndex(0);
        $writer = PHPExcel_IOFactory::createWriter($book, 'Excel5');
        $writer->save('php://output');

        return $this->redirect(['action' => 'index']);
        exit;
    }

    /**
     * 登録された退勤時間を案件の〜分刻みに合わせる。
     *
     * @param string $leave_time フォーマットする退勤時間
     * @param int $format 案件が持つX分刻みにする、のXの部分の数値(例:15分刻みに)
     * @return array
     */
    private function format_time_to_project($leave_time, $format) {
        $result = [];

        //$result = $

        return $result;
    }

    /**
     * TimeオブジェクトをExcelで使用可能な数値にフォーマットする
     *
     * @param array $data フォーマット元データを含む配列
     * @param array $columns フォーマットするデータを持つカラムの配列
     * @return array
     */
    private function format_time_to_excel($data, $columns) {
        $result = [];
        foreach ($columns as $column) {
            $result[$column] = date('H:i', strtotime($data[$column]));
        }
        return $result;
    }
}
