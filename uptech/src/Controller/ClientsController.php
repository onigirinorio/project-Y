<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Clients Controller
 *
 * @property \App\Model\Table\ClientsTable $Clients
 *
 * @method \App\Model\Entity\Client[] paginate($object = null, array $settings = [])
 */
class ClientsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        if(!$this->isAdmin()){
            $this->redirect([
                'controller' => 'Home',
                'action' => 'index'
            ]);
        }
    }


    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        //$clients = $this->Clients->find()->where(['delete_flg' => 0])->all();
        $this->paginate = array(
            'limit' => 15,
            'conditions' => array('delete_flg' => 0)
        );
        $clients = $this->paginate($this->Clients);

        $this->set(compact('clients'));
        $this->set('_serialize', ['clients']);
    }

    /**
     * View method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $client = $this->Clients->get($id, [
            'contain' => ['Clients', 'Projects']
        ]);

        $this->set('client', $client);
        $this->set('_serialize', ['client']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $client = $this->Clients->newEntity();
        if ($this->request->is('post')) {
            $client = $this->Clients->patchEntity($client, $this->request->getData());
            $client['address'] .=$client['address2'];
            if ($this->Clients->save($client)) {
                $this->Flash->success(__('登録に成功しました'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('登録に失敗しました、もう一度お試しください'));
        }
        $this->set(compact('client'));
        $this->set('_serialize', ['client']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $client = $this->Clients->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $client = $this->Clients->patchEntity($client, $this->request->getData());
            if ($this->Clients->save($client)) {
                $this->Flash->success(__('編集に成功しました'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('編集に失敗しました、もう一度お試しください'));
        }
        $this->set(compact('client'));
        $this->set('_serialize', ['client']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $client = $this->Clients->get($id);

        $client->delete_flg = 1;
        if ($this->Clients->save($client)) {
            $this->Flash->success(__('削除に成功しました'));
        } else {
            $this->Flash->error(__('削除に失敗しました、もう一度お試しください'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
