<?php
// src/Model/Entity/ArticlesTag.php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class ArticlesTag extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
        'slug' => false,
    ];
 
}