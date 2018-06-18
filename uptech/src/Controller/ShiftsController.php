<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Shifts Controller
 *
 * @property \App\Model\Table\ShiftsTable $Shifts
 *
 * @method \App\Model\Entity\Shift[] paginate($object = null, array $settings = [])
 */
class ShiftsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
    }

    /**
     * シフト一覧
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $date = new \DateTime();
        $data = $this->request->getQuery();

        // 管理者以外だった場合、閲覧できるデータを制限する
        if ($this->isAdmin() === true) {
            // セレクトボックスで使用するユーザーリスト取得
            $select_users = $this->Shifts->getSelectUsers();
            // 全日付検索、通常検索、検索なしでクエリーを分ける
            if (isset($data['all_date'])) {
                $query = $this->Shifts->find();
            } else {
                // 検索処理
                $query = $this->Shifts->makeQueryGetParameter($data);
            }
        } else {
            $query = $this->Shifts->find()->where(['Shifts.user_id' => $this->user_id]);
        }

        $this->paginate = array(
            'contain' => array('Users', 'Works'),
            'conditions' => array('Shifts.delete_flg = 0'),
            'limit' => 35,
            'order' => ['Shifts.date DESC'],
        );

        $shifts = $this->paginate($query);

        $this->set(compact('select_users'));
        $this->set(compact('shifts'));
        $this->set('_serialize', ['shifts']);
    }

    /**
     * シフト詳細
     *
     * @param string|null $id Shift id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $shift = $this->Shifts->get($id, ['contain' => ['Users']]);

        $this->check_authority($shift->user_id);

        $this->set('shift', $shift);
        $this->set('_serialize', ['shift']);
    }

    /**
     * シフト登録
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $shift = $this->Shifts->newEntity();
        $create_at = date('Y-m-d H:i:s');

        $shift->create_user = $this->user_name;
        $shift->create_at = $create_at;

        if ($this->request->is('post')) {
            $shift = $this->Shifts->patchEntity($shift, $this->request->getData());
            if ($this->Shifts->save($shift)) {
                $this->Flash->success(__('シフトを登録しました。'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('シフトの登録に失敗しました。もう一度お試しください。'));
        }

        $this->set(compact('shift'));
        $this->set('_serialize', ['shift']);
    }

    /**
     * シフト編集
     *
     * @param string|null $id Shift id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $shift = $this->Shifts->get($id, ['contain' => ['Users']]);
        $update_at = date('Y-m-d H:i:s');
        $this->check_authority($shift->user_id);

        $shift->update_user = $this->user_name;
        $shift->upteda_at = $update_at;

        if ($this->request->is(['patch', 'post', 'put'])) {
            $shift = $this->Shifts->patchEntity($shift, $this->request->getData());
            if ($this->Shifts->save($shift)) {
                $this->Flash->success(__('シフトを編集しました。'));
                return $this->redirect(['action' => 'view', $id]);
            }
            $this->Flash->error(__('シフトの編集に失敗しました。もう一度お試しください。'));
        }

        $this->set(compact('shift'));
        $this->set('_serialize', ['shift']);
    }

    /**
     * シフト削除
     *
     * @param string|null $id Shift id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $shift = $this->Shifts->get($id);
        $this->check_authority($shift->user_id);

        $shift->delete_flg = 1;

        if ($this->Shifts->save($shift)) {
            $this->Flash->success(__('シフトを削除しました。'));
        } else {
            $this->Flash->error(__('シフトの削除に失敗しました。もう一度お試しください。'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * カレンダー画面表示用
     */
    public function calendar()
    {
        $search_user_id = $this->Auth->user('id');
        if ($this->isAdmin() === true) {
            // セレクトボックスで使用するユーザーリスト取得
            $select_users = $this->Shifts->getSelectUsers();
        }
        if ($this->request->is('post')) {
            $search_user_id = $this->request->getData('search_user_id');
        }
        $this->set(compact('search_user_id'));
        $this->set(compact('select_users'));
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
                $this->Flash->error('自分自身のシフトデータ以外にはアクセスできません。');
                return $this->redirect(['action' => 'index']);
            }
        }
    }
}
