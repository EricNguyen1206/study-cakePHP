<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProjectUser Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $project_id
 * @property \Cake\I18n\FrozenTime $created_at
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Project $project
 */
class ProjectUser extends Entity
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
        'user_id' => true,
        'project_id' => true,
        'created_at' => true,
        'user' => true,
        'project' => true,
    ];

    protected function _setTableDependencies()
    {
        $this->belongsTo('Users')->setForeignKey('user_id');
        $this->belongsTo('Projects')->setForeignKey('project_id');
    }
}
