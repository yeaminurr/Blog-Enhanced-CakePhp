<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * BridgeView Controller
 *
 * @property \App\Model\Table\BridgeViewTable $BridgeView
 * @method \App\Model\Entity\BridgeView[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BridgeViewController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Articles', 'Roles'],
        ];
        $bridgeView = $this->paginate($this->BridgeView);

        $this->set(compact('bridgeView'));
    }

    /**
     * View method
     *
     * @param string|null $id Bridge View id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bridgeView = $this->BridgeView->get($id, [
            'contain' => ['Articles', 'Roles'],
        ]);

        $this->set(compact('bridgeView'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bridgeView = $this->BridgeView->newEmptyEntity();
        if ($this->request->is('post')) {
            $bridgeView = $this->BridgeView->patchEntity($bridgeView, $this->request->getData());
            if ($this->BridgeView->save($bridgeView)) {
                $this->Flash->success(__('The bridge view has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bridge view could not be saved. Please, try again.'));
        }
        $articles = $this->BridgeView->Articles->find('list', ['limit' => 200])->all();
        $roles = $this->BridgeView->Roles->find('list', ['limit' => 200])->all();
        $this->set(compact('bridgeView', 'articles', 'roles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Bridge View id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bridgeView = $this->BridgeView->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bridgeView = $this->BridgeView->patchEntity($bridgeView, $this->request->getData());
            if ($this->BridgeView->save($bridgeView)) {
                $this->Flash->success(__('The bridge view has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bridge view could not be saved. Please, try again.'));
        }
        $articles = $this->BridgeView->Articles->find('list', ['limit' => 200])->all();
        $roles = $this->BridgeView->Roles->find('list', ['limit' => 200])->all();
        $this->set(compact('bridgeView', 'articles', 'roles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Bridge View id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bridgeView = $this->BridgeView->get($id);
        if ($this->BridgeView->delete($bridgeView)) {
            $this->Flash->success(__('The bridge view has been deleted.'));
        } else {
            $this->Flash->error(__('The bridge view could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
