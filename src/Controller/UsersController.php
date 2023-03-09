<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $result = $this->Authentication->getResult();
        if ($result->isValid()){
            $identity = $this->Authentication->getIdentity();
            $loggedin_user_data = $identity->getOriginalData();
            if ($loggedin_user_data["role"]==2) {
                $users = $this->paginate($this->Users);

                $this->set(compact('users'));
            }
            else{
                $redirect = $this->request->getQuery('redirect', [
                    'controller' => 'Articles',
                    'action' => 'index',
                ]);


                $this->Flash->error(__('You need to be an admin to see user data.'));
                return $this->redirect($redirect);
                //$this->set("nothing");
            }
        }
        else{
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Users',
                'action' => 'login',
            ]);
            $this->Flash->error(__('You need to log in and be an admin to see user data.'));
            return $this->redirect($redirect);
            //$this->set("nothing");
        }

    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $result = $this->Authentication->getResult();
        $options=[1 => 'Author'];
        if ($result->isValid()){

            $identity = $this->Authentication->getIdentity();
            $loggedin_user_data = $identity->getOriginalData();
            //echo $loggedin_user_data;
            if ($loggedin_user_data["role"]==2){
                $options=[2 => 'Admin', 1 => 'Author'];
            }
            //echo json_encode(compact('user','options'));
//            $logged = true;
//
//            $this->set(compact('user','logged','loggedin_user_data'));
//            $this->set('logged',$logged);
//            $this->set('loggedin_user_data',$data);
            #$this->set('user', $user,'');


        }
        $this->set(compact('user','options'));

    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */


    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['login','add']);
        //$this->Authentication->addUnauthenticatedActions(['add']);
    }

    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            // redirect to /articles after login success
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Articles',
                'action' => 'index',
            ]);

            return $this->redirect($redirect);
        }
        // display error if user submitted and authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid email or password'));
        }
    }
    public function logout()
    {
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }




}
