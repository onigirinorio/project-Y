<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

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
        $this->Auth->allow('add');

        // 案件リストを取得
        $this->Projects = TableRegistry::get('Projects');
        $projects = $this->Projects->find()->all();
        $project_list = [];
        foreach ($projects as $key => $value) {
            $project_list[$value['id']] = $value['shop_name'];
        }

        $this->set(compact('project_list'));
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
        if(!$this->isAdmin() && $id != $this->user_id){
            $this->Flash->error(__('自分自身のデータ以外にはアクセスできません。'));
            return $this->redirect(['controller' => 'Works', 'action' => 'index']);
        }
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
        // 管理者以外引数とログイン中のIDが一致しない時
        if(!$this->isAdmin() && $id != $this->Auth->user('id')){
            $this->Flash->error(__('自分自身のデータ以外にはアクセスできません。'));
            $this->redirect(['controller' => 'Works', 'action' => 'index']);
        }
        $user = $this->Users->get($id, [
            'contain' => ['Projects']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            if(empty($data['password']) || $data['password'] === $user['password']){
                if(empty($data['password'])) $data['password'] = $user['password'];
            }
            $user = $this->Users->patchEntity($user, $data,['validate'=>'update']);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('更新しました。'));
                if ($this->isAdmin()) {
                    return $this->redirect(['action' => 'index']);
                } else {
                    return $this->redirect(['action' => 'view', $id]);
                }

            }
            $this->Flash->error(__('登録エラー'));
        }
        $works = $this->Users->Works->find('list', ['limit' => 200]);

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
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('ユーザー削除に成功しました。'));
        } else {
            $this->Flash->error(__('ユーザー削除に失敗しました、もう一度お試しください。'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * 管理者以外は自分自身のデータしか編集できない用制限をする
     *
     */
    private function userIsAdmin(){
        if(!$this->isAdmin() && $this->isLogin()) {
            // 管理者以外、ログイン中
            $this->Flash->error(__('管理者のみアクセスできるページです。'));
            return $this->redirect(['controller' => 'Works', 'action' => 'index']);
        }
    }
}
