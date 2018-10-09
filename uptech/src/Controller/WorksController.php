<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use \PhpOffice\PhpSpreadsheet\IOFactory;

/**
 * Works Controller
 *
 * @property \App\Model\Table\WorksTable $Works
 *
 * @method \App\Model\Entity\Work[] paginate($object = null, array $settings = [])
 */
class WorksController extends AppController
{

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
    }

    /**
     * 出退勤一覧
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $data = $this->request->getQuery();

        // excel出力ボタンが押された場合,excel出力処理へ
        if (isset($data['export_excel'])) {
            $this->downloadExcel($data);
        }

        $select_users = '';
        if ($this->isAdmin() === true) {
            // 検索で使用するユーザーリスト取得
            $this->loadModel('Users');
            $select_users = $this->Users->getSelectUsers();
            // 検索処理
            $query = $this->Works->makeQueryGetParameter($data);
        } else {
            $query = $this->Works->find()->where(
                [
                    'user_id' => $this->Auth->user('id'),
                ]
            );
        }

        $this->paginate = [
            'contain' => ['Users', 'Projects'],
            'conditions' => ['Works.delete_flg = 0'],
            'limit' => 35,
            'order' => ['Works.create_at DESC'],
        ];

        $works = $this->paginate($query);
        $this->set(compact('select_users'));
        $this->set(compact('works'));
        $this->set('_serialize', ['works']);
    }

    /**
     * 出退勤詳細
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

        $this->check_authority($work->user_id);

        $this->set('work', $work);
        $this->set('_serialize', ['work']);
    }

    /**
     * 出勤登録
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        // 管理者だった場合は専用の勤怠登録ページへ遷移
        if ($this->isAdmin() === true) {
            $this->redirect(['action' => 'admin_add']);
        }

        $this->Users = TableRegistry::get('Users');
        $this->Shifts = TableRegistry::get('Shifts');
        $this->loadModel('Projects');
        $user = $this->Users->get($this->Auth->user('id'));

        $work = $this->Works->newEntity();
        if ($this->request->is('post')) {
            $params = $this->request->getData();
            $work = $this->Works->patchEntity($work, $params);
            $project = $this->Projects->get($params['project_id']);
            //作成日時
            $work->create_at = date('Y-m-d H:i:s');
            //休憩時間は登録時は固定で1時間とする。
            $work->break_time = '1:00';
            //残業時間をデフォルトで0に
            $work->overtime = '0:00';
            $work->work_location = $user->work_location;
            // 登録する勤怠の日付のシフトを取得、シフトがなければ出勤登録させない
            $shift = $this->Shifts->find()
                ->where(
                    [
                        'user_id' => $user->id,
                        'date' => date('Y-m-d', strtotime($work->create_at)),
                        'delete_flg' => 0,
                    ]
                )
                ->first();

            if ($shift == null) {
                $this->Flash->error(__('本日はシフト登録されていません。'));
                return $this->redirect(['action' => 'add']);
            }

            if (empty($user->project_id)) {
                $this->Flash->error(__('案件名が設定されていません。管理者に連絡をお願いいたします。'));
                return $this->redirect(['action' => 'add']);
            }

            // シフトよりも早く出勤した場合、出勤データではシフトの出勤時間で登録する
            $work->attend_time = date('H:i');
            if (strtotime($work->attend_time) <= strtotime($shift->attend)) {
                $work->attend_time = $shift->attend;
            } else {
                $work->attend_time = $this->format_attend_time_to_project($work->attend_time, IN_MINUTES[$project->in_minutes]);
            }


            // 既に出勤が登録されていたら保存しない
            if ($this->Works->checkDuplicateWork($user->id, $work->create_at)) {
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
     * 出勤登録(管理者用)
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function adminAdd()
    {
        if(!$this->isAdmin()){
            $this->Flash->error('管理者のみアクセスできるページです。');
            $this->redirect(['controller' => 'Works', 'action' => 'index']);
        }

        $this->Users = TableRegistry::get('Users');
        $this->loadModel('Shifts');
        $this->loadModel('Projects');

        // セレクトボックスで使用するリストを取得
        $user_list = $this->Users->getSelectUsers();
        $project_list = $this->Projects->getSelectProjects();

        $work = $this->Works->newEntity();
        if ($this->request->is('post')) {
            $params = $this->request->getData();
            $work = $this->Works->patchEntity($work, $params);
            $user = $this->Users->get($params['user_id']);
            $create_at = "{$params['create_at']['year']}-{$params['create_at']['month']}-{$params['create_at']['day']}";
            $msg_error = '';

            // 残業時間
            $work->overtime = $this->Works->calc_overtime($work->attend_time, $work->leave_time, $work->break_time);

            if (empty($user->project_id)) {
                $msg_error .= '案件名が設定されていません。管理者に連絡をお願いいたします。';
            }
            // 登録する勤怠の日付のシフトを取得、シフトがなければ出勤登録させない
            if (!$this->Shifts->checkExistShift($params['user_id'], $create_at)) {
                $msg_error .= '指定された日付はシフト登録されていません。';
            }
            // 既に出勤が登録されていたら保存しない
            if ($this->Works->checkDuplicateWork($params['user_id'], $create_at)) {
                $msg_error .= '指定された日付は既に出勤が登録されています。';
            }

            if (empty($msg_error) && $this->Works->save($work)) {
                $this->Flash->success(__('勤怠データを登録しました。'));
                return $this->redirect(['action' => 'add']);
            }

            $msg_error = $msg_error ?? '予期せぬエラーが発生しました、もう一度お試しください。';
            $this->Flash->error(__($msg_error));
        }

        $this->set(compact('work', 'project_list', 'user_list'));
        $this->set('_serialize', ['work']);
    }


    /**
     * 退勤登録
     *
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function addLeave()
    {
        $year = date('Y');
        $month = date('m');
        $day = date('d');
        $work = $this->Works->find()
            ->where(
                [
                    'user_id' => $this->Auth->user('id'),
                    'YEAR(create_at)' => $year,
                    'MONTH(create_at)'=> $month,
                    'DAY(create_at)'=> $day,
                    'Works.delete_flg' => 0,
                ]
            )
            ->contain('Projects')
            ->first();
        $this->loadModel('Projects');
        if (empty($work)) {
            $this->Flash->error(__('本日の出勤データが登録されていません。'));
            return $this->redirect(['action' => 'add']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $work = $this->Works->patchEntity($work, $this->request->getData());
            // 退勤時間の分の部分を案件によって調整する
            $work->leave_time = $this->format_leave_time_to_project($work->leave_time, IN_MINUTES[$work->project->in_minutes]);
            $work->overtime = $this->Works->calc_overtime($work->attend_time, $work->leave_time, $work->break_time);
            if ($this->Works->save($work)) {
                $this->Flash->success(__('退勤が登録されました。'));
                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('退勤の登録に失敗しました。'));
            return $this->redirect(['action' => 'add']);
        }
    }

    /**
     * 出退勤編集
     *
     * @param string|null $id Work id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->loadModel('Projects');
        $work = $this->Works->get($id, [
            'contain' => ['Users', 'Projects']
        ]);

        $this->check_authority($work->user_id);

        // 案件リストを取得
        $project_list = $this->Projects->getSelectProjects();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $param = $this->request->getData();
            $work = $this->Works->patchEntity($work, $param);

            if (isset($param['attend_time']) || isset($param['leave_time']) || isset($param['break_time'])) {
                // 退勤時間の分の部分を案件によって調整する
                $work->leave_time = $this->format_leave_time_to_project($work->leave_time, IN_MINUTES[$work->project->in_minutes]);
                $work->overtime = $this->Works->calc_overtime($work->attend_time, $work->leave_time, $work->break_time);
            }

            if ($this->Works->save($work)) {
                $this->Flash->success(__('勤怠データを編集しました。'));
                return $this->redirect(['action' => 'view', $id]);
            }
            $this->Flash->error(__('勤怠データの編集に失敗しました。もう一度お試しください。'));
            return $this->redirect(['action' => 'view', $id]);
        }

        $this->set(compact('project_list'));
        $this->set(compact('work'));
        $this->set('_serialize', ['work']);
    }

    /**
     * 出退勤削除
     *
     * @param string|null $id Work id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if (!$this->isAdmin()) {
            $this->Flash->error('管理者のみアクセスできるページです。');
            $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);
        $work = $this->Works->get($id);

        //削除フラグに1を代入
        $work->delete_flg = 1;

        if ($this->Works->save($work)) {
            $this->Flash->success(__('勤怠データを削除しました。'));
        } else {
            $this->Flash->error(__('勤怠データの削除に失敗しました。もう一度お試しください。'));
        }

        return $this->redirect(['action' => 'index']);
    }


    /**
     * 勤怠Excel出力用
     * @param array|null $data 勤怠一覧にて設定された検索条件
     * @return null
     * @TODO コンポーネントとして切り出す
     */
    public function downloadExcel($data = null)
    {
        // $data = $this->request->getData();
        $search_user_id = $data['search_user_id'];
        $search_year = $data['search_date']['year'];
        $search_month = $data['search_date']['month'];
        $search_day = $data['search_date']['day'];
        $transport_expenses_flg = $data['transport_expenses_flg'] === '1';

        // ユーザー、年、月の選択がされているかチェックする
        if (empty($search_user_id) || empty($search_year) || empty($search_month) || !empty($search_day)) {
            $this->Flash->error('Excel出力をする際はユーザー・年・月を設定した状態で出力してください。');
            return $this->return_works_list($data);
        }

        $this->Users = TableRegistry::get('Users');
        $user = $this->Users->get($search_user_id);

        // 勤怠データ取得
        $works = $this->Works->find()
            ->where(
                [
                    'Works.user_id' => $search_user_id,
                    'YEAR(create_at)' => $search_year,
                    'MONTH(create_at)' => $search_month,
                    'delete_flg' => 0,
                ]
            )
            ->all()
            ->toArray();

        // 勤怠データが存在するかチェックする
        if (empty($works)) {
            $this->Flash->error('指定された条件の勤怠データは存在しませんでした。');
            return $this->return_works_list($data);
        }

        // 全ての勤怠データで退勤時間が入力されているかチェックする
        foreach ($works as $work) {
            if (is_null($work['leave_time'])) {
                $this->Flash->error('退勤時間が入力されていない勤怠データが存在します。');
                return $this->return_works_list($data);
            }
        }

        // 入出力の情報設定
        $driPath    = realpath(WWW_ROOT) . "/excel/";
        $inputPath  = $driPath . "template2.xls";
        if ($transport_expenses_flg) {
            $inputPath  = $driPath . "template_travel_expenses.xls";
        }
        $sheetName  = "Sheet1";
        $outputFile = $user['name'] . "_" . $search_year . "_" . $search_month . ".xls";

        // Excelファイル作成
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xls');
        $book   = $reader->load($inputPath);
        $sheet  = $book->getSheetByName($sheetName);

        // ユーザー名記入
        $sheet->setCellValue('V1', $user['name']);
        // 日付記入
        $sheet->setCellValue('A1', $search_year);
        $sheet->setCellValue('G1', ltrim($search_month, "0"));
        // 稼働データ記入
//        $total_hour = 0;
//        $total_minutes = 0;
//        $total_over_hour = 0;
//        $total_over_minutes = 0;

        for ($i = 0; $i < 31; $i++) {
            $work = null;
            foreach ($works as $key => $value) {
                if (date('j', strtotime($value['create_at'])) == ($i + 1)) {
                    $work = $value;
                }
            }
            if (isset($work)) {
                $work_time_int = $this->Works->calc_work_time($work['attend_time'], $work['leave_time'], $work['break_time']);
                $work_time = gmdate('H:i', $work_time_int);

                // excel用にTimeオブジェクトをフォーマットするカラムをセット
                $columns = ['attend_time', 'leave_time', 'break_time', 'overtime'];
                // excel用にTimeオブジェクトをフォーマットする
                $times = $this->format_time_to_excel($work, $columns);

                $rowNum = 4 + $i;
                $sheet->setCellValue('E' . $rowNum, $times['attend_time']);
                $sheet->setCellValue('J' . $rowNum, $times['leave_time']);
                $sheet->setCellValue('O' . $rowNum, $times['break_time']);
                $sheet->getStyle('T' . $rowNum)->getNumberFormat()->setFormatCode('h:mm');
                $sheet->setCellValue('T' . $rowNum, $work_time);
                $sheet->setCellValue('Y' . $rowNum, $times['overtime']);
                $sheet->setCellValue('AD' . $rowNum, $work->remarks);
                if ($transport_expenses_flg) {
                    $sheet->setCellValue('AL' . $rowNum, $work->transport_expenses);
                }
//                $total_hour += date('H', strtotime($work_time));
//                $total_minutes += date('i', strtotime($work_time));
//                $total_over_hour += date('H', strtotime($times['overtime']));
//                $total_over_minutes += date('i', strtotime($times['overtime']));
            }
        }
        // 合計時間を計算しセット
//        $total_hour = $total_hour + floor($total_minutes / 60);
//        $total_minutes = sprintf('%02d', $total_minutes % 60);
//        $sheet->setCellValue('T35', "{$total_hour}:{$total_minutes}");
//        $total_over_hour = $total_over_hour + floor($total_over_minutes / 60);
//        $total_over_minutes = sprintf('%02d', $total_over_minutes % 60);
//        $sheet->setCellValue('Y35', "{$total_over_hour}:{$total_over_minutes}");

        // ダウンロード
        $book->setActiveSheetIndex(0);
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($book, 'Xls');
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-Disposition: attachment;filename="' . $outputFile . '"');
        header('Cache-Control: max-age=0');
        header("Content-Transfer-Encoding: binary ");
        $writer->save('php://output');
        exit();
    }


    /**
     * 登録された出勤時間を案件の〜分刻みに合わせる。
     *
     * @param object $attend_time フォーマットする出勤時間(Timeオブジェクト)
     * @param int $format 案件が持つX分刻みにする、のXの部分の数値(例:15分刻みにする場合は15)
     * @return int フォーマットで丸められた分の数値
     */
    private function format_attend_time_to_project($attend_time, $format)
    {
        $attend_time_minuite = date('i', strtotime($attend_time));
        $minute = (floor($attend_time_minuite / $format) + 1) * $format;

        if ($minute === 60) {
            $attend_time->modify('+1 hours');
            $minute = '00';
        }

        $result = substr_replace($attend_time, $minute, -2);
        return $result;
    }

    /**
     * 登録された退勤時間を案件の〜分刻みに合わせる。
     *
     * @param object $leave_time フォーマットする退勤時間(Timeオブジェクト)
     * @param int $format 案件が持つX分刻みにする、のXの部分の数値(例:15分刻みにする場合は15)
     * @return int フォーマットで丸められた分の数値
     */
    private function format_leave_time_to_project($leave_time, $format)
    {
        $leave_time_minuite = date('i', strtotime($leave_time));
        $minute = floor($leave_time_minuite / $format) * $format;
        $result = substr_replace($leave_time, $minute, -2);
        return $result;
    }

    /**
     * 時間ををExcelで使用可能な数値にフォーマットする
     *
     * @param array $data フォーマット元データを含む配列
     * @param array $columns フォーマットするデータを持つカラムの配列
     * @return array
     */
    private function format_time_to_excel($data, $columns)
    {
        $result = [];
        foreach ($columns as $column) {
            $result[$column] = date('H:i', strtotime($data[$column]));
        }
        return $result;
    }

    /**
     * 検索結果を維持したまま一覧ページへリダイレクトする
     * @param array $data リダイレクト先に渡すパラメータの配列
     * @return object リダイレクト先
     */
    public function return_works_list($data)
    {
        return $this->redirect((
        [
            'action' => 'index',
            '?' => [
                'search_user_id' => isset($data['search_user_id']) ? $data['search_user_id'] : '',
                'search_date[year]' => isset($data['search_date']['year']) ? $data['search_date']['year'] : '',
                'search_date[month]' => isset($data['search_date']['month']) ? $data['search_date']['month'] : '',
                'search_date[day]' => isset($data['search_date']['day']) ? $data['search_date']['day'] : ''
            ]
        ]
        ));
    }

    /**
     * 管理者以外のユーザーが自分以外の勤怠データにアクセスしようとした場合に一覧にリダイレクトさせる
     * @param integer $user_id ユーザーID
     * @return object リダイレクト先
     */
    private function check_authority($user_id)
    {
        if (!$this->isAdmin()) {
            if ($user_id != $this->user_id) {
                $this->Flash->error('自分自身の勤怠データ以外にはアクセスできません。');
                return $this->redirect(['action' => 'index']);
            }
        }
    }

}
