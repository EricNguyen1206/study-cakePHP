<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Authentication\PasswordHasher\DefaultPasswordHasher;

class User extends Entity
{
  // Define accessible fields
  protected $_accessible = [
    '*' => true,
    'id' => false,
  ];

  // Set hidden fields for JSON/Array conversion (e.g., hiding the password)
  protected $_hidden = [
    'password',
  ];
  // Automatically hash passwords when setting them
  protected function _setPassword(string $password)
  {
    if (strlen($password) > 0) {
      $hasher = new DefaultPasswordHasher();
      return $hasher->hash($password);
    }
    return null;
  }
}
