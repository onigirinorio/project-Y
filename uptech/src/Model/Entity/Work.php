<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Work Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $project_id
 * @property \Cake\I18n\FrozenTime $attend_time
 * @property \Cake\I18n\FrozenTime $leave_time
 * @property \Cake\I18n\FrozenTime $break_time
 * @property \Cake\I18n\FrozenTime $overtime
 * @property \Cake\I18n\FrozenTime $create_at
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Project $project
 */
class Work extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
