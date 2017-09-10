<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Shift Entity
 *
 * @property int $id
 * @property int $user_id
 * @property \Cake\I18n\FrozenDate $date
 * @property \Cake\I18n\FrozenTime $attend
 * @property \Cake\I18n\FrozenTime $clock
 * @property bool $holiday_flag
 * @property string $create_user
 * @property \Cake\I18n\FrozenTime $create_at
 * @property string $update_user
 * @property \Cake\I18n\FrozenTime $upteda_at
 *
 * @property \App\Model\Entity\User $user
 */
class Shift extends Entity
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
