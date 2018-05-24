<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use function Sodium\add;

/**
 * Clients Model
 *
 * @property \App\Model\Table\ClientsTable|\Cake\ORM\Association\BelongsTo $Clients
 * @property \App\Model\Table\ClientsTable|\Cake\ORM\Association\HasMany $Client
 * @property \App\Model\Table\ProjectsTable|\Cake\ORM\Association\HasMany $Projects
 *
 * @method \App\Model\Entity\Client get($primaryKey, $options = [])
 * @method \App\Model\Entity\Client newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Client[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Client|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Client patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Client[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Client findOrCreate($search, callable $callback = null, $options = [])
 */
class ClientsTable extends Table
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

        $this->setTable('clients');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Projects', [
            'foreignKey' => 'client_id',
        ]);
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
            ->scalar('client_name')
            ->requirePresence('client_name', 'create')
            ->notEmpty('client_name', 'クライアント名を入力してください。')
            ->add('client_name', [
                'maxLength' => [
                    'rule' => ['maxLength', 50],
                    'message' => 'クライアント名は50文字以内で入力してください。'
                ]
            ])
            // 電話番号
            ->integer('tell', '電話番号には数字のみを入力してください。')
            ->notEmpty('tell', '電話番号を入力してください。')
            ->add('tell', [
                'maxLength' => [
                    'rule' => ['maxLength', 11],
                    'message' => '電話番号は11桁以内で入力してください。'
                ]
            ])
            // 郵便番号
            ->integer('zip_code', '郵便番号には数字のみを入力してください')
            ->notEmpty('zip_code', '郵便番号を入力してください。')
            ->add('zip_code', [
                'minLength' => [
                    'rule' => ['minLength', 7],
                    'message' => '郵便番号は7桁で入力してください。'
                ],
                'maxLength' => [
                    'rule' => ['maxLength', 7],
                    'message' => '郵便番号は7桁で入力してください。',
                ]
            ])
            ->scalar('pref')
            ->notEmpty('pref', '都道府県を入力してください。')
            // 住所
            ->scalar('address')
            ->notEmpty('address', '住所を入力してください。')
            ->add('address', [
                'maxLength' => [
                    'rule' => ['maxLength', 256],
                    'message' => '住所は256文字以内で入力してください。'
                ]
            ]);

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
//        $rules->add($rules->existsIn(['client_id'], 'Clients'));

        return $rules;
    }
}
