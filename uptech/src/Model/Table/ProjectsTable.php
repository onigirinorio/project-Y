<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Projects Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ClientsTable|\Cake\ORM\Association\BelongsTo $Clients
 *
 * @method \App\Model\Entity\Project get($primaryKey, $options = [])
 * @method \App\Model\Entity\Project newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Project[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Project|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Project patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Project[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Project findOrCreate($search, callable $callback = null, $options = [])
 */
class ProjectsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('projects');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Works', [
            'foreignKey' => 'project_id'
        ]);
        $this->BelongsTo('Clients');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create')
            // クライアント名
            ->integer('client_id')
            ->notEmpty('client_id', 'クライアント名を選択してください。')
            // 支払い区分
            ->integer('payment_status')
            ->notEmpty('payment_status', '支払区分を選択してください。')
            // 金額
            ->integer('price', '金額は数字のみを入力してください。')
            ->notEmpty('price', '金額を入力してください。')
            // 案件名
            ->scalar('shop_name')
            ->notEmpty('shop_name', '案件名を入力してください。')
            ->add('shop_name', [
                'maxLength' => [
                    'rule' => ['maxLength', 50],
                    'message' => '案件名は50文字以内で入力してください。'
                ]
            ])
            // 交通費
            ->integer('expense')
            ->allowEmpty('expense');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        // Userのアソシエーションエラーになるため使用しない場合はコメントアウト
        // $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['client_id'], 'Clients'));

        return $rules;
    }
}
