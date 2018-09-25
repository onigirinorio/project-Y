<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */


class UsersController extends AppController
{

    public function initialize()
    {
        parent::initialize();
//        $this->Auth->allow('add');

        // 案件リストを取得
        $this->Projects = TableRegistry::get('Projects');
        $projects = $this->Projects->find()->all();
        $project_list = [];
        foreach ($projects as $key => $value) {
            $project_list[$value['id']] = $value['shop_name'];
        }

        $this->set(compact('project_list'));
    }
    public function beforeFilter(Event $event)
    {
        if (in_array($this->request->action, ['searchUserAjax'])) {
            $this->Security->setConfig('unlockedActions', ['searchUserAjax']);
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->userIsAdmin();
        $this->paginate = array(
            "contain" => array("Projects"),
            'conditions' => array('Users.delete_flg = 0'),
            'limit' => 15,
        );
        $users = $this->paginate($this->Users);
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        // 管理者以外引数とログイン中のIDが一致しない時
        $this->check_authority($id);

        $user = $this->Users->get($id, [
            'contain' => ['Works', 'Projects']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->userIsAdmin();
        $user = $this->Users->newEntity();
        $user_count = $this->Users->find()->where(['delete_flg' => 0])->count();
        if ($user_count >= USER_LIMIT) {
            $this->Flash->error(__('ユーザー数が登録上限に達しています。これ以上のユーザー登録を行う為にはプラン変更が必要です。'));
            $this->redirect(['action' => 'index']);
        }

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user['address'] .=$user['address2'];
            $user->gender = (int)$user->gender;
            if ($this->Users->save($user)) {
                $this->Flash->success(__('ユーザー新規登録が完了しました。'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('ユーザー登録に失敗しました、もう一度お試しください。'));
        }

        $works = $this->Users->Works->find('list', ['limit' => 200]);
        $this->set(compact('user', 'works'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        // 管理者以外かつページIDとログイン中のIDが一致しない時
        $this->check_authority($id);

        $user = $this->Users->get($id, ['contain' => ['Projects']]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('ユーザー情報を更新しました。'));
                return $this->redirect(['action' => 'view', $id]);
            }
            $this->Flash->error(__('ユーザー情報の更新に失敗しました。もう一度お試しください。'));
        }
        $works = $this->Users->Works->find('list', ['limit' => 200]);

        $this->set(compact('id'));
        $this->set(compact('user', 'works'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->userIsAdmin();
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        $user->delete_flg = 1;
        if ($this->Users->save($user)) {
            $this->Flash->success(__('ユーザー削除に成功しました。'));
        } else {
            $this->Flash->error(__('ユーザー削除に失敗しました、もう一度お試しください。'));
        }

        return $this->redirect(['action' => 'index']);
    }


    /**
     * パスワード変更画面
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function changePassword($id = null)
    {
        // 管理者以外かつページIDとログイン中のIDが一致しない時
        $this->check_authority($id);

        $user = $this->Users->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('パスワードを変更しました。'));
                return $this->redirect(['action' => 'view', $id]);
            }
            $this->Flash->error(__('パスワードの変更に失敗しました。もう一度お試しください。'));
        }
        $works = $this->Users->Works->find('list', ['limit' => 200]);

        $this->set(compact('id'));
        $this->set(compact('user', 'works'));
        $this->set('_serialize', ['user']);
    }

    /**
     * 勤怠登録で使用するajax用のアクション
     *
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     * ＠todo Ajaxコントローラーに移した方がいいかも
     */
    public function searchUserAjax()
    {
        $this->autoRender = false;
        $params = $this->request->getdata();
        $user = $this->Users->find()
                    ->select(['id', 'project_id', 'work_location'])
                    ->where([
                        'id' => $params['user_id'],
                        'delete_flg' => 0
                    ])
                    ->first()
                    ->toArray();
        echo json_encode($user);
    }

    /**
     * 管理者以外はアクセスできないページに使用する
     *
     */
    private function userIsAdmin(){
        if(!$this->isAdmin() && $this->isLogin()) {
            // 管理者以外、ログイン中
            $this->Flash->error(__('管理者のみアクセスできるページです。'));
            return $this->redirect(['controller' => 'Works', 'action' => 'index']);
        }
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
                $this->Flash->error('自分自身のデータ以外にはアクセスできません。');
                return $this->redirect(['action' => 'view', $this->user_id]);
            }
        }
    }
}
