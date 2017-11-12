<?php
namespace App\Controller;

use App\Controller\AppController;

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
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->userIsAdmin();
        $this->paginate = [
            'contain' => ['Works']
        ];
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
        $this->userIsAdmin();
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
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
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
            $this->redirect([
                'controller' => 'Home',
                'action' => 'index'
            ]);
        }
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            if(empty($data['password']) || $data['password'] === $user['password']){
                if(empty($data['password'])) $data['password'] = $user['password'];
            }
            $user = $this->Users->patchEntity($user, $data,['validate'=>'update']);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('更新しました。'));

                return $this->redirect(['action' => 'index']);
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
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * ユーザー画面のみ管理者以外をedit(自分のIDのみ)とaddに行かせるため
     *
     */
    private function userIsAdmin(){
        if(!$this->isAdmin() && $this->isLogin()) {
            // 管理者以外、ログイン中
            $this->redirect([
                'controller' => 'Home',
                'action' => 'index'
            ]);
        } elseif ($this->request->getParam('action') === 'add' && !$this->isLogin()) {
            // 未ログイン、新規登録画面
            return true;
        }
    }
}
