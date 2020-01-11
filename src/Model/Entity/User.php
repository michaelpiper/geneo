<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

// in src/Model/Entity/User.php
use Authentication\PasswordHasher\DefaultPasswordHasher;
class User extends Entity
{
    // ... other methods

    // Automatically hash passwords when they are changed.
    protected function _setPassword(string $password)
    {
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($password);
    }
}