<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Projects Controller
 *
 *
 * @method \App\Model\Entity\Project[] paginate($object = null, array $settings = [])
 */
class ProjectsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->Clients = TableRegistry::get('Clients');
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
        //ClientsテーブルをJOIN
        $this->paginate = array(
            "contain" => array("Clients"),
            'conditions' => array('Projects.delete_flg = 0'),
            'limit' => 15,
        );
        $projects = $this->paginate();

        $this->set(compact('projects'));
        $this->set('_serialize', ['projects']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $project = $this->Projects->newEntity();

        $clientList = $this->Clients->find('list', array(
            'keyField' => 'id',
            'valueField' => 'client_name',
        ))
        ->toArray();

        $this->set('clientList', $clientList);

        if ($this->request->is('post')) {
            $project = $this->Projects->patchEntity($project, $this->request->getData());
            if ($this->Projects->save($project)) {
                $this->Flash->success(__('案件を新規作成しました。'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('予期せぬエラーが起きました。'));
        }
        $this->set(compact('project'));
        $this->set('_serialize', ['project']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Project id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $project = $this->Projects->get($id, [
            'contain' => []
        ]);

        $clientList = $this->Clients->find('list', array(
            'keyField' => 'id',
            'valueField' => 'client_name',
        ))
        ->toArray();

        $this->set('clientList', $clientList);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $project = $this->Projects->patchEntity($project, $this->request->getData());
            if ($this->Projects->save($project)) {
                $this->Flash->success(__('案件を編集しました。'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('予期せぬエラーが発生しました。'));
        }
        $this->set(compact('project'));
        $this->set('_serialize', ['project']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Project id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $project = $this->Projects->get($id);

            //削除フラグに1を代入
            $project->delete_flg = 1;

            if ($this->Projects->save($project)) {
                $this->Flash->success(__('案件を削除しました。'));
            } else {
                $this->Flash->error(__('予期せぬエラーが発生しました。'));
            }


        return $this->redirect(['action' => 'index']);
    }
}
