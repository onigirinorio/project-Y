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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->date('date')
            ->allowEmpty('date');

        $validator
            ->time('attend')
            ->allowEmpty('attend');

        $validator
            ->time('clock')
            ->allowEmpty('clock');

        $validator
            ->boolean('holiday_flag')
            ->allowEmpty('holiday_flag');

        $validator
            ->scalar('create_user')
            ->allowEmpty('create_user');

        $validator
            ->dateTime('create_at')
            ->allowEmpty('create_at');

        $validator
            ->scalar('update_user')
            ->allowEmpty('update_user');

        $validator
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
}
