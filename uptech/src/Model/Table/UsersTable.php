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
        $this->BelongsTo('Projects');
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
            // ユーザー名
            ->scalar('name')
            ->notEmpty('name', 'ユーザー名を入力してください。')
            ->add('name', [
                'maxLength' => [
                    'rule' => ['maxLength', 36],
                    'message' => 'ユーザー名は36文字以内で入力してください。'
                ]
            ])
            // ユーザー名(カナ)
            ->scalar('name_kana')
            ->notEmpty('name_kana', 'ユーザー名(カナ)を入力してください。')
            ->add('name_kana', [
                'maxLength' => [
                    'rule' => ['maxLength', 36],
                    'message' => 'ユーザー名(カナ)は36文字以内で入力してください。'
                ]
            ])
            // パスワード
            ->scalar('password')
            ->notEmpty('password', 'create', 'パスワードを入力してください。')
            ->add('password', [
                'minLength' => [
                    'rule' => ['minLength', 6],
                    'last' => true,
                    'message' => 'パスワードは6文字以上、16文字以内で入力してください。'
                ],
                'maxLength' => [
                    'rule' => ['maxLength', 16],
                    'message' => 'パスワードは6文字以上、16文字以内で入力してください。'
                ],
                'comWith' => [  //←任意のバリデーション名
                    'rule' => ['compareWith','password_check'],  //←バリデーションのルール
                    'message' => '確認用のパスワードと一致しません'  //←エラー時のメッセージ
                ]
            ])
            // メールアドレス
            ->email('email')
            ->notEmpty('email', 'メールアドレスを入力してください。')
            ->add('email', [
                'validFormat' => [
                    'rule'=> 'email',
                    'message' => 'メールアドレスの形式が正しくありません。'
                ],
                'maxLength' => [
                    'rule' => ['maxLength', 256],
                    'message' => 'メールアドレスは256文字以内で入力してください。'
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
            // 性別
            ->boolean('gendar')
            ->notEmpty('gendar', '性別を入力してください。')
            // 生年月日
            ->date('birth')
            ->notEmpty('birth', '生年月日を入力してください。')
            // 郵便番号
            ->integer('zip_code', '郵便番号には数字のみを入力してください。')
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
            // 都道府県
            ->scalar('pref')
            ->notEmpty('pref', '都道府県を入力してください。')
            // 住所
            ->scalar('address')
            ->notEmpty('address', '住所を入力してください。')
            // 開始日
            ->date('start_date')
            ->allowEmpty('start_date')
            // 終了日
            ->date('end_date')
            ->allowEmpty('end_date')
            // 交通経路
            ->scalar('expense_route')
            ->notEmpty('expense_route', '交通経路を入力してください。1月の間で変動する場合は特殊と入力してください。')
            // 交通費
            ->integer('expense_price')
            ->allowEmpty('expense_price')
            // 勤務先
            ->scalar('work_location')
            ->allowEmpty('work_location');


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

    /**
     * セレクトボックス用のユーザーデータを取得
     *
     * @return array ユーザーの配列
     */
    public function getSelectUsers() {
        $select_users = [];
        $users = $this->find()->where(['delete_flg' => 0])->order(['CAST(name_kana AS CHAR)' => 'ASC'])->all()->toArray();
        foreach ($users as $user) {
            $select_users[$user->id] = $user->name;
        }
        return $select_users;
    }
}
