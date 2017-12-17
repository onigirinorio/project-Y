<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

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
            'limit' => 15,
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
        $user = $this->Users->get($this->Auth->user('id'));

        $work = $this->Works->newEntity();
        if ($this->request->is('post')) {
            $work = $this->Works->patchEntity($work, $this->request->getData());
            //出勤時間
            $work->attend_time = date('H:i');
            //作成日時
            $create_at = date('Y-m-d H:i:s');
            $work->create_at = $create_at;
            //休憩時間は登録時は固定で1時間とする。
            $work->break_time = '1:00';
            //残業時間をデフォルトで0に
            $work->overtime = '0:00';
            if ($this->Works->save($work)) {
                $this->Flash->success(__('出勤を登録しました。'));
                return $this->redirect(['action' => 'add']);
            }
          $this->Flash->error(__('予期せぬエラーが発生しました。'));
        }

        $project = $user->project_id;

        // 以下1ボタン登録になるにあたり不要
        // $users = $this->Works->Users->find('list', ['limit' => 200]);
        // $projects = $this->Works->Projects->find('list', ['limit' => 200]);
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
        $work->leave_time = date('H:i');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $work = $this->Works->patchEntity($work, $this->request->getData());
            $attend = strtotime($work->attend_time);
            $leave = strtotime($work->leave_time);
            $break = strtotime($work->break_time);
            $work['overtime'] = $this->Works->calc_overtime($attend, $leave, $break);
            if ($this->Works->save($work)) {
                $this->Flash->success(__('退勤が登録されました。'));

                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The work could not be saved. Please, try again.'));
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
}
