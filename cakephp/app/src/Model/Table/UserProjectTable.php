<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UserProjectTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('user_project');
        $this->setPrimaryKey('id');

        // Associations
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Projects', [
            'foreignKey' => 'project_id',
            'joinType' => 'INNER',
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmptyString('user_id', 'User ID is required')
            ->notEmptyString('project_id', 'Project ID is required');

        return $validator;
    }
}
