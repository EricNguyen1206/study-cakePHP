<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Comment Entity
 *
 * @property int $id
 * @property string $content
 * @property int $user_id
 * @property int $note_id
 * @property \Cake\I18n\FrozenTime $created_at
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Note $note
 */
class Comment extends Entity
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
        'content' => true,
        'user_id' => true,
        'note_id' => true,
        'created_at' => true,
        'user' => true,
        'note' => true,
    ];
}
