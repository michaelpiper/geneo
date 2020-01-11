<?php
// src/Model/Table/ArticlesTagsTable.php
namespace App\Model\Table;

use Cake\ORM\Table;

class ArticlesTagsTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
    }
}