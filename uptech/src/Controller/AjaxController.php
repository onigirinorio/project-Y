<?php
/**
 * Created by PhpStorm.
 * User: joedie
 * Date: 2017/12/03
 * Time: 16:04
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


class AjaxController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function calender($type = 'shift')
    {

        if($this->request->is('ajax')){
            if ($type === 'shift') {
                $data = $this->getShift();
            } else {
                $data = $this->getWorks();
            }
        }else{
            $data = null;
        }
        $this->set('data', $data);
        $this->set('_serialize', 'data');

    }
}