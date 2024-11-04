<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{
  public function initialize(array $config)
  {
    parent::initialize($config);

    $this->setTable('users');
    $this->setPrimaryKey('id');
    $this->setDisplayField('username');
    $this->addBehavior('Timestamp', [
      'created' => 'created_at',
      'modified' => false
    ]);

    // Define relationship with Notes table
    $this->hasMany('Notes', [
      'foreignKey' => 'user_id',
      'dependent' => true, // Cascade delete notes if a user is deleted
    ]);
  }

  public function validationDefault(Validator $validator)
  {
    $validator
      ->notEmptyString('username', 'Username is required')
      ->maxLength('username', 50)
      ->email('email', false, 'Please enter a valid email')
      ->notEmptyString('password', 'Password is required');

    return $validator;
  }
}
