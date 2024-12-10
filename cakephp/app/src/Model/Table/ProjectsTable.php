<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ProjectsTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('projects');
        $this->setPrimaryKey('id');

        // Association with Users
        $this->belongsTo('Users', [
            'foreignKey' => 'created_by',
            'joinType' => 'INNER',
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmptyString('title', 'Title is required')
            ->maxLength('title', 255, 'Title cannot exceed 255 characters')
            ->notEmptyString('created_by', 'Created by is required')
            ->add('status', 'inList', [
                'rule' => ['inList', ['active', 'archived']],
                'message' => 'Invalid status value'
            ]);

        return $validator;
    }
}
