<?php
// src/Controller/ArticlesController.php

namespace App\Controller;
use App\Model\Table\UsersTable;
use App\Model\Table\CommentsTable;
use App\Model\Table\CategoriesTable;
use App\Model\Table\TagsTable;
class ArticlesController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['index','view','search']);
        $this->Users=new UsersTable();
        $this->Comments=new CommentsTable();
        $this->Categories= new CategoriesTable();
        $this->Tags= new TagsTable();
    }
    public function index()
    {
        $this->loadComponent('Paginator');
        $articles = $this->Paginator->paginate($this->Articles->find()->where(['published'=>1]));
        $mostViewed=$this->Articles->find()->where(['published'=>1])->first();
        $popular_articles=$this->Articles->find()->where(['published'=>1])->order('viewed DESC');
        $owner=$this->Users->find()->where(['owner'=>1])->first();
        $p_categories = $this->Categories->find();
        $p_tags = $this->Tags->find();
        $this->set(compact('mostViewed'));
        $this->set(compact('popular_articles'));
        $this->set(compact('owner'));
        $this->set(compact('articles'));
        $this->set(compact('p_categories'));
        $this->set(compact('p_tags'));
        $this->set('Users',$this->Users);
    }
    // Add to existing src/Controller/ArticlesController.php file

    public function view($slug = null)
    {
        $this->loadComponent('Paginator');
        $article = $this->Articles->findBySlug($slug)->where(['published'=>1])->firstOrFail();
        $popular_articles=$this->Articles->find()->where(['published'=>1])->order('viewed DESC');
        $owner=$this->Users->find()->where(['owner'=>1])->first();
        $comments =  $this->Paginator->paginate($this->Comments->find()->where(['article_id'=>$article->id]));
        $comment = $this->Comments->newEmptyEntity();
        $category = [];
        $p_categories = $this->Categories->find();
        $p_tags = $this->Tags->find();
        $category = $this->Categories->find()->where(['id'=>$article->id]);
        
        if ($this->request->is('post')) {
            $data =$this->request->getData();
            if(isset($data['_action']) && $data['_action'] =='comment'){
                
                $comment = $this->Comments->patchEntity($comment, $data);
                $comment->article_id = $article->id;
                if(!isset($data['subject'])){
                    $this->Flash->error(__('Subject not decleared'));
                }
                else if(!isset($data['message']) || strlen($data['message'])<4){
                    $this->Flash->error(__('Message can\'t be empty'));
                }else{
                    if($this->Comments->save($comment)){
                        $this->Flash->success(__('Comment has been saved.'));
                        return $this->redirect(['action' => 'view',$slug]);
                    }
                }
            }
            
        }
        $this->set(compact('article'));
        $this->set(compact('comments'));
        $this->set(compact('comment'));
        $this->set('Users',$this->Users);
        $this->Articles->patchEntity($article, ['viewed'=> intval($article->viewed)+1]);
        // $article->
        $this->set(compact('category'));
        $this->set(compact('p_categories'));
        $this->set(compact('popular_articles'));
        $this->set(compact('owner'));
        $this->set(compact('p_tags'));
        $this->Articles->save($article);
    }
    public function search(){
        $this->loadComponent('Paginator');
        if(isset($_GET['q']))
        $articles = $this->Paginator->paginate($this->Articles->find()->where(['published'=>1,'title'=>$_GET['q']]));
        else
        $articles = $this->Paginator->paginate($this->Articles->find()->where(['published'=>1]));

        $mostViewed=$this->Articles->find()->where(['published'=>1])->first();
        $popular_articles=$this->Articles->find()->where(['published'=>1])->order('viewed DESC');
        $owner=$this->Users->find()->where(['owner'=>1])->first();
        $p_categories = $this->Categories->find();
        $p_tags = $this->Tags->find();
        $this->set(compact('mostViewed'));
        $this->set(compact('owner'));
        $this->set(compact('articles'));
        $this->set(compact('p_categories'));
        $this->set(compact('p_tags'));
        $this->set(compact('popular_articles'));
        $this->set('Users',$this->Users);
    }
}