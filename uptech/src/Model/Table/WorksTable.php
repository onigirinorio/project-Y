<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Works Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ProjectsTable|\Cake\ORM\Association\BelongsTo $Projects
 *
 * @method \App\Model\Entity\Work get($primaryKey, $options = [])
 * @method \App\Model\Entity\Work newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Work[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Work|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Work patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Work[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Work findOrCreate($search, callable $callback = null, $options = [])
 */
class WorksTable extends Table
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

        $this->setTable('works');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Projects', [
            'foreignKey' => 'project_id',
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
            ->allowEmpty('id', 'create')

            // 出勤時間
            ->time('attend_time')
            ->notEmpty('attend_time', '出勤時間を入力してください。')

            // 退勤時間
            ->time('leave_time')
            ->allowEmpty('leave_time')

            // 休憩時間
            ->time('break_time')
            ->notEmpty('break_time', '休憩時間を入力してください。')

            // 残業時間
            ->time('overtime')
            ->allowEmpty('overtime')

            // 備考
            ->allowEmpty('remarks')
            ->add('remarks', [
                    'maxLength' => [
                        'rule' => ['maxLength', 20],
                        'message' => '備考は20文字以内で入力してください。'
                    ]
                ]
            )

            // 出勤場所
            ->scalar('location_add')
            ->allowEmpty('location_add')

            // 退勤場所
            ->scalar('location_leave')
            ->allowEmpty('location_leave')

            // 勤務先
            ->scalar('work_location')
            ->allowEmpty('work_location')

            // 交通費
            ->integer('transport_expenses')
            ->allowEmpty('transport_expenses')

            // 作成時間
            //->dateTime('create_at')
            ->allowEmpty('create_at');

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
        $rules->add($rules->existsIn(['project_id'], 'Projects'));

        return $rules;
    }


    // 以下ビジネスロジック


    /**
     * 一覧画面の検索で使用するクエリを返す
     * @param array $get_param 検索条件の配列
     * @return string クエリ
     */
    public function makeQueryGetParameter($get_param)
    {
        $query = $this->find();
        if (!empty($get_param['search_user_id'])) {
            $query->where(['Works.user_id' => $get_param['search_user_id']]);
        }

        if (!empty($get_param['search_date']['year'])) {
            $query->where([
                'YEAR(create_at)' => $get_param['search_date']['year'],
            ]);
        }

        if (!empty($get_param['search_date']['month'])) {
            $query->where([
                'MONTH(create_at)' => $get_param['search_date']['month'],
            ]);
        }

        if (!empty($get_param['search_date']['day'])) {
            $query->where([
                'DAY(create_at)' => $get_param['search_date']['day'],
            ]);
        }
        return $query;
    }

    /**
     * 勤怠データの重複チェックを行う
     * @param int $user_id 勤怠データのユーザーID
     * @param string $date 重複チェックをする勤怠データの日付
     * @return boolean 重複データが存在する時にtrue
     */
    public function checkDuplicateWork($user_id, $date)
    {
        $work = $this->find()
            ->where(
                [
                    'user_id' => $user_id,
                    "DATE_FORMAT(create_at,'%Y%m%d') = DATE_FORMAT('{$date}','%Y%m%d')",
                    'delete_flg' => 0,
                ]
            )
            ->toArray();

        return !empty($work);
    }

    /**
     * 残業時間を計算
     * @param object $attend 出勤時間
     * @param object $leave 退勤時間
     * @param object $break 休憩時間
     * @return string 残業時間
     */
    public function calc_overtime($attend, $leave, $break)
    {
        // 実働時間を取得
        $work_time = $this->calc_work_time($attend, $leave, $break);
        // 残業時間を計算
        $overtime = $work_time - (60 * 60 * 8);
        if ($overtime < 0) {
            $overtime = 0;
        }
        return gmdate('H:i:s', $overtime);
    }

    /**
     * 実働時間を計算
     * @param object $attend 出勤時間
     * @param object $leave 退勤時間
     * @param object $break 休憩時間
     * @return int 実働時間
     */
    public function calc_work_time($attend, $leave, $break)
    {
        $attend = strtotime($attend);
        $leave = strtotime($leave);
        $break = strtotime($break) - strtotime('00:00:00');
        return $leave - ($attend + $break);
    }

}
