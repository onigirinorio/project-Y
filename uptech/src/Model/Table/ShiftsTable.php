<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Shifts Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Shift get($primaryKey, $options = [])
 * @method \App\Model\Entity\Shift newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Shift[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Shift|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Shift patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Shift[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Shift findOrCreate($search, callable $callback = null, $options = [])
 */
class ShiftsTable extends Table
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

        $this->setTable('shifts');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
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
            // ID
            ->integer('id')
            ->allowEmpty('id', 'create')
            // 日付
            ->date('date')
            ->notEmpty('date', '日付を入力してください。')
            // 出勤予定時間
            ->time('attend')
            ->notEmpty('attend', '出勤時間を入力してください。')
            // 退勤予定時間
            ->time('clock')
            ->notEmpty('clock', '退勤時間を入力してください。')
            // 休日フラグ
            ->boolean('holiday_flag')
            ->allowEmpty('holiday_flag')
            // シフト作成者
            ->scalar('create_user')
            ->allowEmpty('create_user')
            // 作成日時
            ->dateTime('create_at')
            ->allowEmpty('create_at')
            // シフト更新者
            ->scalar('update_user')
            ->allowEmpty('update_user')
            // 更新日時
            ->dateTime('upteda_at')
            ->allowEmpty('upteda_at');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }

    // 以下ビジネスロジック

    /**
     * 一覧画面のユーザーセレクトボックス用のデータを取得
     * @return array セレクトボックス用のユーザーデータ
     */
    public function getSelectUsers() {
        $users = $this->Users->find()->all()->toArray();
        foreach ($users as $user) {
            $select_users[$user->id] = $user->name;
        }
        return $select_users;
    }

}
