<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Table\BridgeViewTable;
use Cake\Controller\Controller;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 * @property \App\Model\Table\BridgeViewTable $Bridge
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArticlesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {

        $bridgetable = Controller::fetchtable(
            'BridgeView'
        );
        $identity = $this->Authentication->getIdentity();
        $loggedin_user_data = $identity->getOriginalData();

        $bridgetable->find()->where(['user_role'=>$loggedin_user_data["role_id"]]);


        $articles = $this->paginate($this->Articles->find()->where(['user_id'=>$loggedin_user_data["id"]]));

        $this->set(compact('articles'));
    }
    public function mysubmission(){

        $identity = $this->Authentication->getIdentity();
        $loggedin_user_data = $identity->getOriginalData();


        $articles = $this->paginate($this->Articles->find()->where(['user_id'=>$loggedin_user_data["id"]]));

        $this->set(compact('articles'));
    }

    /**
     * View method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {

        $article = $this->Articles->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('article'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
//        $bridgetable = Controller::loadModel(
//            'BridgeViewTable'
//        );
        $bridgetable = Controller::fetchtable(
            'BridgeView'
        );

        $article = $this->Articles->newEmptyEntity();
        echo $article;
        //$bridge = ClassRegistry::init('Bridge')->newEmptyEntity();
        $bridge =$bridgetable->newEmptyEntity();

        if ($this->request->is('post')) {

            $article = $this->Articles->patchEntity($article, $this->request->getData());
            $identity = $this->Authentication->getIdentity();
            $loggedin_user_data = $identity->getOriginalData();
            //$article["created"]=$loggedin_user_data["id"];
            $article["user_id"]=$loggedin_user_data["id"];
            //echo $article;
            //echo $bridgepatch;


            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));


                $role_id = $this->request->getData('role_id');

                foreach ($role_id as $value){

                    $bridgepatch =   $bridgetable->patchEntity($bridge, $this->request->getData());
                    $bridgepatch['article_id']=$article['id'];
                    $bridgepatch['role_id']=$value;
                    $bridgetable->save($bridgepatch);
                    $bridge =$bridgetable->newEmptyEntity();
                }

                //$bridgetable->save($bridgepatch);
                //print_r( $this->request->getData('role_id'));


                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }
        $this->set(compact('article','bridge'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }
        $this->set(compact('article'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The article has been deleted.'));
        } else {
            $this->Flash->error(__('The article could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function logout()
    {
        $redirect = $this->request->getQuery('redirect', [
            'controller' => 'Users',
            'action' => 'logout',
        ]);
        return $this->redirect($redirect);



    }

    public function addUser()
    {
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            return $this->redirect(['controller' => 'Users', 'action' => 'add']);
        }
    }
}
