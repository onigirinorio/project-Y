<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\WorksTable|\Cake\ORM\Association\BelongsTo $Works
 * @property \App\Model\Table\ProjectsTable|\Cake\ORM\Association\HasMany $Projects
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Works', [
            'foreignKey' => 'user_id'
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
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('name')
            ->notEmpty('name', '名前を入力してください。');

        $validator
            ->scalar('name_kana')
            ->notEmpty('name_kana', '名前(かな)を入力してください。');
        $validator
            ->scalar('password')
            ->notEmpty('password', 'パスワードを入力してください。')
            ->add('password', [
                'minLength' => [
                    'rule' => ['minLength', 6],
                    'last' => true,
                    'message' => 'パスワードは６文字以上、１６文字以内で入力してください。'
                ],
                'maxLength' => [
                    'rule' => ['maxLength', 16],
                    'message' => 'パスワードは６文字以上、１６文字以内で入力してください。'
                ]
            ]);

        $validator
            ->email('email')
            ->notEmpty('email', 'メールアドレスを入力してください。');

        $validator
            ->integer('tell')
            ->notEmpty('tell', '電話番号を入力してください。');

        $validator
            ->boolean('gendar')
            ->notEmpty('gendar', '性別を入力してください。');

        $validator
            ->date('birth')
            ->notEmpty('birth', '生年月日を入力してください。');

        $validator
            ->integer('zip_code')
            ->notEmpty('zip_code', '郵便番号を入力してください。');

        $validator
            ->scalar('pref')
            ->notEmpty('pref', '都道府県を入力してください。');

        $validator
            ->scalar('address')
            ->notEmpty('address', '住所を入力してください。');

        return $validator;
    }
    public function validationUpdate($validator)
    {
        $validator->scalar('password');
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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['work_id'], 'Works'));

        return $rules;
    }
}
