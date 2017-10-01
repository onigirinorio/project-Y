<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $name
 * @property string $name_kana
 * @property string $password
 * @property string $email
 * @property int $tell
 * @property bool $gendar
 * @property \Cake\I18n\FrozenDate $birth
 * @property int $zip_code
 * @property string $pref
 * @property string $address
 * @property int $work_id
 *
 * @property \App\Model\Entity\Work $work
 * @property \App\Model\Entity\Project[] $projects
 */
class User extends Entity
{
    /**
     * パスワードのハッシュ
     *  @param $password stringg
     *  @var $password string
     * @return string
     */
    protected function _setPassword($password)
    {
        return (new DefaultPasswordHasher)->hash($password);
    }

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

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
