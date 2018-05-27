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

    // 各コントローラーで使用できるクラス変数を定義
    protected $is_login, $user_name, $user_id, $admin_flg, $user_agent;

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        //ログイン認証の設定
        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'userModel' => 'Users',
                    'fields' => ['username' => 'email', 'password' => 'password']
                ]
            ],
            'loginAction' => [
                'controller' => '/',
                'action' => 'login',
            ],
            'loginRedirect' => [
                'controller' => '/',
                'action' => '' //top
            ],
            'logoutRedirect' => [
                'controller' => '/',
                'action' => 'login',
            ],
            'authError' => __('長時間操作がなかった為、ログアウトしました。')
        ]);

        // ログイン判定、ユーザー情報、管理者フラグ、ユーザーエージェントを取得しクラス変数に代入
        $is_login   = $this->isLogin();
        $admin_flg  = $this->isAdmin();
        $user_name  = $this->user_name  = $this->Auth->user('name');
        $user_id    = $this->user_id    = $this->Auth->user('id');
        $user_agent = $this->user_agent = $this->get_user_agent();

        // 取得した各情報をビューにセット
        $this->set(compact('is_login'));
        $this->set(compact('user_agent'));
        $this->set(compact('user_name'));
        $this->set(compact('user_id'));
        $this->set(compact('admin_flg'));

        $this->loadComponent('Security');
        $this->loadComponent('Csrf');
    }

    /**
     * 管理者判定
     * @return bool 管理者フラグ
     */
    public function isAdmin(){
        $admin_flg = false;
        if($this->Auth->user('adminflg') == 1){
            $admin_flg = true;
        }
        return $admin_flg;
    }

    /**
     * ログイン判定
     * @return bool ログインフラグ
     */
    public function isLogin(){
        $is_login = false;
        if(!empty($this->Auth->user())) {
            $is_login = true;
        }
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
     * @param int $user_id 取得するユーザーID
     * @return array
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


    /**
     * ユーザーエージェントを取得
     * @return string ユーザーエージェントの種別（pc,smart,tablet,cellphone）
     */
    public function get_user_agent() {
        $ua = $_SERVER['HTTP_USER_AGENT'];

        if ((strpos($ua, 'Android') !== false) && (strpos($ua, 'Mobile') !== false) || (strpos($ua, 'iPhone') !== false) || (strpos($ua, 'Windows Phone') !== false)) {
            // スマートフォンからアクセスされた場合
            $ua = 'smart';
        } elseif ((strpos($ua, 'Android') !== false) || (strpos($ua, 'iPad') !== false)) {
            // タブレットからアクセスされた場合
            $ua = 'tablet';
        } elseif ((strpos($ua, 'DoCoMo') !== false) || (strpos($ua, 'KDDI') !== false) || (strpos($ua, 'SoftBank') !== false) || (strpos($ua, 'Vodafone') !== false) || (strpos($ua, 'J-PHONE') !== false)) {
            // 携帯からアクセスされた場合
            $ua = 'cellphone';
        } else {
            // その他（PC）からアクセスされた場合
            $ua = 'pc';
        }
        return $ua;
    }

}
