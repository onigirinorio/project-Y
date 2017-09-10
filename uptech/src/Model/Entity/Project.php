<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Project Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $client_id
 * @property bool $payment_status
 * @property int $price
 * @property string $shop_name
 * @property \Cake\I18n\FrozenTime $start__date
 * @property \Cake\I18n\FrozenTime $end_date
 * @property int $expense
 * @property bool $expense_status
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Client $client
 */
class Project extends Entity
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
