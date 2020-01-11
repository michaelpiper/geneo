<?php
// src/Model/Entity/Tag.php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Tag extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
        'slug' => false,
    ];
 
}