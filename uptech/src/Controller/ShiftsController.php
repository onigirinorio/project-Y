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
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        // 管理者以外だった場合、閲覧できるデータを制限する
        if ($this->isAdmin() === true) {
            $query = $this->Shifts->find();
        } else {
            $query = $this->Shifts->find()->where(
                [
                    'user_id' => $this->Auth->user('id')
                ]
            );
        }

        $this->paginate = array(
            'contain' => array('Users'),
            'conditions' => array('Shifts.delete_flg = 0'),
            'limit' => 35,
            'order' => ['Shifts.date DESC'],
        );

        $shifts = $this->paginate($query);

        $this->set(compact('shifts'));
        $this->set('_serialize', ['shifts']);
    }

    /**
     * View method
     *
     * @param string|null $id Shift id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $shift = $this->Shifts->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('shift', $shift);
        $this->set('_serialize', ['shift']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $shift = $this->Shifts->newEntity();
        $create_at = date('Y-m-d H:i:s');
        //登録者を仮の値を代入 (後で変更)
        $shift->create_user = $this->Auth->user('name');
        $shift->create_at = $create_at;

        if ($this->request->is('post')) {
            $shift = $this->Shifts->patchEntity($shift, $this->request->getData());
            if ($this->Shifts->save($shift)) {
                $this->Flash->success(__('シフトを登録しました。'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('予期せぬエラーが発生しました。'));
        }
        $users = $this->Shifts->Users->find('list', ['limit' => 200]);
        $this->set(compact('shift', 'users'));
        $this->set('_serialize', ['shift']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Shift id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $shift = $this->Shifts->get($id, [
            'contain' => ['Users']
        ]);
          $update_at = date('Y-m-d H:i:s');
          //更新者に仮の値を代入 (あとで変更)
          $shift->update_user = $this->Auth->user('name');;
          $shift->upteda_at = $update_at;

          if ($this->request->is(['patch', 'post', 'put'])) {
              $shift = $this->Shifts->patchEntity($shift, $this->request->getData());
                  if ($this->Shifts->save($shift)) {
                      $this->Flash->success(__('シフトを編集しました。'));

                      return $this->redirect(['action' => 'view', $id]);
                  }
              $this->Flash->error(__('予期せぬエラーが発生しました。'));
        }
        $users = $this->Shifts->Users->find('list', ['limit' => 200]);
        $this->set(compact('shift', 'users'));
        $this->set('_serialize', ['shift']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Shift id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $shift = $this->Shifts->get($id);

            //削除フラグに1を代入
            $shift->delete_flg = 1;

            if ($this->Shifts->save($shift)) {
                $this->Flash->success(__('シフトを削除しました。'));
            } else {
                $this->Flash->error(__('予期せぬエラーが発生しました。'));
            }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * カレンダー画面表示用
     *
     * @param string|null $user_id ユーザーID
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function calendar()
    {
        if ($this->isAdmin() === true) {
            // セレクトボックスで使用するユーザーリスト取得
            $select_users = $this->Shifts->getSelectUsers();
        }
        if ($this->request->is('post')) {
            $search_user_id = $this->request->getData('search_user_id');
            $this->set(compact('search_user_id'));
        }
        $this->set(compact('select_users'));
    }
}
