<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class NotesTable extends Table
{
  public function initialize(array $config)
  {
    parent::initialize($config);

    $this->setTable('notes');
    $this->setPrimaryKey('id');
    $this->setDisplayField('title');
    $this->addBehavior('Timestamp', [
      'created' => 'created_at',
      'modified' => 'updated_at'
    ]);

    // Define relationship with Users table
    $this->belongsTo('Users', [
      'foreignKey' => 'user_id',
      'joinType' => 'INNER',
    ]);
  }

  public function validationDefault(Validator $validator)
  {
    $validator
      ->notEmptyString('title', 'Title is required')
      ->maxLength('title', 255)
      ->allowEmptyString('description');

    return $validator;
  }
}
