<?php
// src/Controller/HomeController.php

namespace App\Controller;
use App\Model\Table\ArticlesTable;
class HomeController extends AppController
{
    public function index()
    {
        $this->redirect('/');
        $this->loadComponent('Paginator');
        $this->Articles=new ArticlesTable();
        $articles = $this->Paginator->paginate($this->Articles->find());
        $this->set(compact('articles'));
    }
}