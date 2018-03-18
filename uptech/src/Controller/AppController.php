<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        //ログイン認証の設定
        $this->loadComponent('Auth', [
            'loginAction' => [
                'controller' => 'Home',
                'action' => 'login',
            ],
            'loginRedirect' => [
                'controller' => 'Home',
                'action' => 'top'
            ],
            'authenticate' => [
                'Form' => [
                    'userModel' => 'Users',
                    'fields' => ['username' => 'email', 'password' => 'password']
                ]
            ]
        ]);

        // ログイン判定
        $this->isLogin();
        // ユーザー情報をビューにセット
        $user_name = $this->Auth->user('name');
        $user_id = $this->Auth->user('id');
        // 管理者フラグをセット

        $this->isAdmin();
        $this->set('user_name',$user_name);
        $this->set('user_id',$user_id);
        /*
         * Enable the following components for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }

    /**
     * 管理者判定
     * @return bool 管理者フラグ
     */
    public function isAdmin(){
        $admin = false;
        if($this->Auth->user('adminflg') == 1){
            $admin = true;
        }
        $this->set('admin_flg',$admin);
        return $admin;
    }

    /**
     * ログイン判定
     * @return bool ログインフラグ
     */
    public function isLogin(){
        if(!empty($this->Auth->user())) {
            $is_login = true;
        } else {
            $is_login = false;
        }
        $this->set('is_login',$is_login);
        return $is_login;
    }
    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Http\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        // Note: These defaults are just to get started quickly with development
        // and should not be used in production. You should instead set "_serialize"
        // in each action as required.
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }



    /**
     * シフトを取得
     * @return
     */
    public function getShift($user_id = null){
        $shifts = TableRegistry::get('Shifts');
        if($user_id === null){
            $user_id = $this->Auth->user('id');
        }
        $query = $shifts->find('all',
            [
                'conditions'=>[
                    'Shifts.user_id'=> $user_id,
                    'Shifts.delete_flg' => 0,
                ],
            ]
        )
        ->join([
            'table' => 'works',
            'alias' => 'Works',
            'type' => 'left',
            'conditions' => [
                'Works.user_id' => $user_id,
                "DATE_FORMAT(Works.create_at,'%Y%m%d') = DATE_FORMAT(Shifts.date,'%Y%m%d')"
            ]
        ]
        )
        ->select(
            [
                'attend_time'=>'Works.attend_time',
                'leave_time'=>'Works.leave_time',
                'create_at'=>'Works.create_at',
                'date'=>'Shifts.date',
                'shift_attend'=>'Shifts.attend',
                'shift_clock'=>'Shifts.clock',
            ]
        )
        ->toArray();
        foreach ($query as $val){
            $val['date'] = $val['date']->i18nFormat('YYYY-MM-dd');
            $val['shift_attend'] = $val['shift_attend']->i18nFormat('HH:mm:ss');
            $val['shift_clock'] = $val['shift_clock']->i18nFormat('HH:mm:ss');
        }
        return $query;
    }

}
