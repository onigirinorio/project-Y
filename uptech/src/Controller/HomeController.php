<?php
/**
 * Created by PhpStorm.
 * User: joedie
 * Date: 2017/09/10
 * Time: 17:01
 */

namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
use Cake\View\Exception\MissingTemplateException;
use PhpParser\Builder\Class_;


/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 */

class HomeController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */

    public $helpers = ['Card'];

    public function index(){
        $this->getShift();
    }

    public function top () {

    }

    public function login()
    {
        if($this->Auth->user()){
            //ログイン中はホーム画面へリダイレクト
            return $this->redirect('/');
        }

        if($this->request->is('post')){
            $user = $this->Auth->identify();
            if($user){
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('ユーザー名かパスワードが間違ってまっせ');
        }
    }

    public function logout(){
        $logoutUrl = $this->Auth->logout();
        $this->redirect($logoutUrl);
    }

}
