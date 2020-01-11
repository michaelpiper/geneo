<?php
// src/Controller/ArticlesController.php

namespace App\Controller;
use App\Model\Table\UsersTable;
use App\Model\Table\CommentsTable;
use App\Model\Table\CategoriesTable;
use App\Model\Table\TagsTable;
use App\Model\Table\ArticlesTable;
class AboutController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['index']);
        $this->Users=new UsersTable();
        $this->Comments=new CommentsTable();
        $this->Categories= new CategoriesTable();
        $this->Tags= new TagsTable();
        $this->Articles= new ArticlesTable();
    }
    public function index()
    {
        $this->loadComponent('Paginator');
        $articles = $this->Paginator->paginate($this->Articles->find()->where(['published'=>1]));
        $mostViewed=$this->Articles->find()->where(['published'=>1])->first();
        $owner=$this->Users->find()->where(['owner'=>1])->first();
        $p_categories = $this->Categories->find();
        $p_tags = $this->Tags->find();
        $this->set(compact('mostViewed'));
        $this->set(compact('owner'));
        $this->set(compact('articles'));
        $this->set(compact('p_categories'));
        $this->set(compact('p_tags'));
        $this->set('Users',$this->Users);
    }
   
}