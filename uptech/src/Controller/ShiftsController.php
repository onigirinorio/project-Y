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

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $shifts = $this->paginate($this->Shifts);

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
        if ($this->request->is('post')) {
            $shift = $this->Shifts->patchEntity($shift, $this->request->getData());
            if ($this->Shifts->save($shift)) {
                $this->Flash->success(__('The shift has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The shift could not be saved. Please, try again.'));
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
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $shift = $this->Shifts->patchEntity($shift, $this->request->getData());
            if ($this->Shifts->save($shift)) {
                $this->Flash->success(__('The shift has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The shift could not be saved. Please, try again.'));
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
        if ($this->Shifts->delete($shift)) {
            $this->Flash->success(__('The shift has been deleted.'));
        } else {
            $this->Flash->error(__('The shift could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
