<?php
// src/Controller/HomeController.php

namespace App\Controller;
use App\Model\Table\UsersTable;
use App\Model\Table\ArticlesTable;
use App\Model\Table\TagsTable;
use App\Model\Table\CategoriesTable;
class DashboardController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['login']);
        $this->Users=new UsersTable();
        $this->Articles= new ArticlesTable;
        $this->Tags= new TagsTable;
        $this->Categories= new CategoriesTable;
        $this->Identity=$this->Authentication->getIdentity();
        
    }

    public function index()
    {
        $this->set('article',700);
    }
    public function profile(){

    }
    public function editProfile(){
        $user = $this->Users
        ->find()
        ->where(['id' => $this->Identity->get('id')])
        ->firstOrFail();

        if ($this->request->is(['post', 'put'])) {
            $this->Users->patchEntity($user, $this->request->getData());
            $user->id=$this->Identity->get('id');
            $against_email = $this->Users
            ->find()
            ->where(['email' => $user->email])
            ->first();
            $against_username= $this->Users
            ->find()
            ->where(['username' => $user->username])
            ->first();
            if($against_email && $user->id!=$against_email->id){
                $this->Flash->error(__('Email already taken'));
            }
            elseif($against_username && $user->id!=$against_username->id){
                $this->Flash->error(__('Username already taken'));
            }else{
                $uploads_dir = 'uploads/users/';
                if(!file_exists($uploads_dir)){
                    mkdir($uploads_dir,0777,true);
                }
                if(isset($_FILES["picture"])){ 
                    $ext_type = array('gif','jpg','jpe','jpeg','png');
                    $error=$_FILES["picture"]["error"];
                    if ($error == UPLOAD_ERR_OK) {
                        $tmp_name = $_FILES["picture"]["tmp_name"];
                        // basename() may prevent filesystem traversal attacks;
                        // further validation/sanitation of the filename may be appropriate
                        $name = basename($_FILES["picture"]["name"]);
                        $ext= pathinfo($name,PATHINFO_EXTENSION);
                        
                        $filename=$uploads_dir.md5(microtime(true)).".{$ext}";
                        if(!$ext || !in_array(strtolower($ext),$ext_type)){
                            $this->Flash->error(__('Image file format not allowed'));
                        }
                        elseif(!move_uploaded_file($tmp_name,$filename)){
                            $this->Flash->error(__('Display image could not be uploaded'));
                        }else{
                            $oldfile=$user->cover_image;
                            $this->Users->patchEntity($user, ['display_image'=>'/'.$filename]);
                            if($this->Users->save($user)) {
                                if($oldfile && file_exists('webroot'.$oldfile)){
                                    unlink('webroot'.$oldfile);
                                }
                                $this->Flash->success(__('Your display image has been saved.'.$user->cover_image));
                                return $this->redirect(['action' => 'logout']); 
                            }else{
                                unlink($filename);
                            }
                        }
                    }
                }else{
                    if($this->Users->save($user)) {
                        $this->Flash->success(__('Your display image has been saved.'));
                        return $this->redirect(['action' => 'logout']); 
                    }
                    $this->Flash->error(__('Unable to save your user.'));
                }
            }
           
            
        }
        $this->set('user', $user);
    }
    public function changePassword(){
      
        $user = $this->Users
        ->find()
        ->where(['id' => $this->Identity->get('id')])
        ->firstOrFail();
        
        if ($this->request->is(['post', 'put'])) {
            $data =$this->request->getData();
            $password=null;
            
            $user->id=$this->Identity->get('id');
            if(!isset($data['current_password']) || strlen($data['current_password'])<1){
                $this->Flash->error(__('Current password can\'t be empty'));
            }
            else if(!isset($data['new_password']) || strlen($data['new_password'])<6){
                $this->Flash->error(__('Current password can\'t be less than 8 character'));
            }
            else if (!isset($data['new_password']) || !isset($data['confirm_password']) || $data['new_password']!=$data['confirm_password']){
                $this->Flash->error(__('New password not the same with confirm password'));
            }
            else if(!password_verify($data['current_password'],$user->password)){
                $this->Flash->error(__('Password incorrect'));
            }
            else{
                $user->password=$data['new_password'];
                if ( $this->Users->save($user)) {
                    $this->Flash->success(__('User password has been updated.'));
                    return $this->redirect(['action' => 'profile']);
                }
                $this->Flash->error(__('Unable to change user password.'));
            }
        }

        $this->set('user', $user);
    }
    public function article($slug){
        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        $this->set(compact('article'));
    }
    public function articles(){
        $this->loadComponent('Paginator');
        $query=$this->Articles->find();

        if(!$this->Identity->get('admin')){
            $query->where(['user_id'=>$this->Identity->get('id')]);
        }
        $articles = $this->Paginator->paginate($query);
        $this->set(compact('articles'));
    }
    public function addArticle(){
        $article = $this->Articles->newEmptyEntity();
       
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            $article->cover_image = 'saslkas.png';
            $against_title= $this->Articles
            ->find()
            ->where(['title' => $article->title])
            ->first();
            if($article->title==null || strlen($article->title)<5){
                $this->Flash->error(__('Article title can\'t be empty'));
            }
            elseif($article->body==null || strlen($article->body)<20){
                $this->Flash->error(__('Article body can\'t be empty'));
            }
            elseif($against_title && $article->title!=$against_title->title){
                $this->Flash->error(__('Article with this title already exist'));
            }else{ 
                $uploads_dir = 'uploads/articles/';
                if(!file_exists($uploads_dir)){
                    mkdir($uploads_dir,null,true);
                }
                if(isset($_FILES["picture"])){ 
                    $ext_type = array('gif','jpg','jpe','jpeg','png');
                    $error=$_FILES["picture"]["error"];
                    if ($error == UPLOAD_ERR_OK) {
                        $tmp_name = $_FILES["picture"]["tmp_name"];
                        // basename() may prevent filesystem traversal attacks;
                        // further validation/sanitation of the filename may be appropriate
                        $name = basename($_FILES["picture"]["name"]);
                        $ext= pathinfo($name,PATHINFO_EXTENSION);
                        
                        $filename=$uploads_dir.md5(microtime(true)).".{$ext}";
                        if(!$ext || !in_array(strtolower($ext),$ext_type)){
                            $this->Flash->error(__('Image file format not allowed'));
                        }
                        elseif(!move_uploaded_file($tmp_name,$filename)){
                            $this->Flash->error(__('Article image could not be uploaded'));
                        }else{
                            $article->cover_image ='/'.$filename;
                            if($this->Articles->save($article)) {
                                $this->Flash->success(__('Your article has been saved.'));
                                // return $this->redirect(['action' => 'articles']); 
                            }else{
                                unlink($filename);
                            }
                        }
                    }
                }else{
                    if($this->Articles->save($article)) {
                        $this->Flash->success(__('Your article has been saved.'));
                        return $this->redirect(['action' => 'articles']); 
                    }
                    $this->Flash->error(__('Unable to add your article.'));
                }
               
            }
            
        }
        $this->set('article', $article);
        $query=$this->Categories->find();
        $categoriesTable=$query;
        $categories=[];
        foreach($categoriesTable as $category){
            $categories[$category->id]=$category->title;
        }
        $this->set(compact('categories'));

    }
   
    public function editArticle($slug){
        $article = $this->Articles
        ->findBySlug($slug)
        // ->contain('Tags') // load associated Tags
        ->firstOrFail();

        if ($this->request->is(['post', 'put'])) {
            $this->Articles->patchEntity($article, $this->request->getData());
            $against_title= $this->Articles
            ->find()
            ->where(['title' => $article->title])
            ->first();

            if($article->title==null || strlen($article->title)<5){
                $this->Flash->error(__('Article title can\'t be empty'));
            }
            elseif($article->body==null || strlen($article->body)<20){
                $this->Flash->error(__('Article body can\'t be empty'));
            }
            elseif($against_title && $article->id!=$against_title->id){
                $this->Flash->error(__('Article with this title already exist'));
            }else{
                $uploads_dir = 'uploads/articles/';
                if(!file_exists($uploads_dir)){
                    mkdir($uploads_dir,0777,true);
                }
                if(isset($_FILES["picture"])){ 
                    $ext_type = array('gif','jpg','jpe','jpeg','png');
                    $error=$_FILES["picture"]["error"];
                    if ($error == UPLOAD_ERR_OK) {
                        $tmp_name = $_FILES["picture"]["tmp_name"];
                        // basename() may prevent filesystem traversal attacks;
                        // further validation/sanitation of the filename may be appropriate
                        $name = basename($_FILES["picture"]["name"]);
                        $ext= pathinfo($name,PATHINFO_EXTENSION);
                        
                        $filename=$uploads_dir.md5(microtime(true)).".{$ext}";
                        if(!$ext || !in_array(strtolower($ext),$ext_type)){
                            $this->Flash->error(__('Image file format not allowed'));
                        }
                        elseif(!move_uploaded_file($tmp_name,$filename)){
                            $this->Flash->error(__('Article image could not be uploaded'));
                        }else{
                            $oldfile=$article->cover_image;
                            $this->Articles->patchEntity($article, ['cover_image'=>'/'.$filename]);
                            if($this->Articles->save($article)) {
                                if($oldfile && file_exists('webroot'.$oldfile)){
                                    unlink('webroot'.$oldfile);
                                }
                                $this->Flash->success(__('Your article has been updated.'.$article->cover_image));
                                // $this->redirect(['action' => 'articles']); 
                            }else{
                                unlink($filename);
                            }
                        }
                    }
                }else{
                    if($this->Articles->save($article)) {
                        $this->Flash->success(__('Your article has been updated.'));
                        return $this->redirect(['action' => 'articles']); 
                    }
                    $this->Flash->error(__('Unable to update your article.'));
                }
                if ($this->Articles->save($article)) {
                    $this->Flash->success(__('Your article has been updated.'));
                    return $this->redirect(['action' => 'articles']);
                }   
            }
        }

        $this->set('article', $article);
    }
    
    public function deleteArticle($slug){
        $this->request->allowMethod(['post', 'delete', 'get']);

        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The '.$article->id.' article has been deleted.', $article->title));
            return $this->redirect(['action' => 'articles']);
        }
    }
    public function publishArticle($slug){
        $this->request->allowMethod(['post', 'put', 'get']);
        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        
        $this->Articles->patchEntity($article, ['published'=>'1']);
        if ($this->Articles->save($article)) {
            $this->Flash->success(__('The '.$article->id.' article has been published.', $article->title));
            return $this->redirect(['action' => 'articles']);
        }
    }
    public function unpublishArticle($slug){
        $this->request->allowMethod(['post', 'put', 'get']);
        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        
        $this->Articles->patchEntity($article, ['published'=>'0']);
        if ($this->Articles->save($article)) {
            $this->Flash->success(__('The '.$article->id.' article has been un published.', $article->title));
            return $this->redirect(['action' => 'articles']);
        }
    }
    public function tag($id){
        $tag = $this->Tags->find()
        ->where(['id'=>$id])
        ->firstOrFail();
        $this->set(compact('tag'));
    }
    public function tags(){
        $this->loadComponent('Paginator');
        $query=$this->Tags->find();
        $tags = $this->Paginator->paginate($query);
        $this->set(compact('tags'));
    }
    public function addTag(){
        $tag = $this->Tags->newEmptyEntity();
        if ($this->request->is('post')) {
            $tag = $this->Tags->patchEntity($tag, $this->request->getData());
            $against_title= $this->Tags
            ->find()
            ->where(['title' => $tag->title])
            ->first();
            if($against_title && $tag->id!=$against_title->id){
                $this->Flash->error(__('Tag with this title already exist'));
            }else{
                $uploads_dir = 'uploads/tags/';
                if(!file_exists($uploads_dir)){
                    mkdir($uploads_dir,0777,true);
                }
                if(isset($_FILES["picture"])){ 
                    $ext_type = array('gif','jpg','jpe','jpeg','png');
                    $error=$_FILES["picture"]["error"];
                    if ($error == UPLOAD_ERR_OK) {
                        $tmp_name = $_FILES["picture"]["tmp_name"];
                        // basename() may prevent filesystem traversal attacks;
                        // further validation/sanitation of the filename may be appropriate
                        $name = basename($_FILES["picture"]["name"]);
                        $ext= pathinfo($name,PATHINFO_EXTENSION);
                        
                        $filename=$uploads_dir.md5(microtime(true)).".{$ext}";
                        if(!$ext || !in_array(strtolower($ext),$ext_type)){
                            $this->Flash->error(__('Image file format not allowed'));
                        }
                        elseif(!move_uploaded_file($tmp_name,$filename)){
                            $this->Flash->error(__('Tag image could not be uploaded'));
                        }else{
                            $oldfile=$tag->cover_image;
                            $this->Tags->patchEntity($tag, ['cover_image'=>'/'.$filename]);
                            if($this->Tags->save($tag)) {
                                if($oldfile && file_exists('webroot'.$oldfile)){
                                    unlink('webroot'.$oldfile);
                                }
                                $this->Flash->success(__('Your tag has been saved.'.$tag->cover_image));
                                return $this->redirect(['action' => 'tags']); 
                            }else{
                                unlink($filename);
                            }
                        }
                    }
                }else{
                    if($this->Tags->save($tag)) {
                        $this->Flash->success(__('Your tag has been saved.'));
                        return $this->redirect(['action' => 'tags']); 
                    }
                    $this->Flash->error(__('Unable to save your tag.'));
                }
            }
        }
        $this->set('tag', $tag);
    }
   
    public function editTag($id){
        $tag = $this->Tags->find()
        ->where(['id'=>$id])
        ->firstOrFail();

        if ($this->request->is(['post', 'put'])) {
            $this->Tags->patchEntity($tag, $this->request->getData());
            $against_title= $this->Tags
            ->find()
            ->where(['title' => $tag->title])
            ->first();
            if($against_title && $tag->id!=$against_title->id){
                $this->Flash->error(__('Tag with this title already exist'));
            }else{
                $uploads_dir = 'uploads/tags/';
                if(!file_exists($uploads_dir)){
                    mkdir($uploads_dir,0777,true);
                }
                if(isset($_FILES["picture"])){ 
                    $ext_type = array('gif','jpg','jpe','jpeg','png');
                    $error=$_FILES["picture"]["error"];
                    if ($error == UPLOAD_ERR_OK) {
                        $tmp_name = $_FILES["picture"]["tmp_name"];
                        // basename() may prevent filesystem traversal attacks;
                        // further validation/sanitation of the filename may be appropriate
                        $name = basename($_FILES["picture"]["name"]);
                        $ext= pathinfo($name,PATHINFO_EXTENSION);
                        
                        $filename=$uploads_dir.md5(microtime(true)).".{$ext}";
                        if(!$ext || !in_array(strtolower($ext),$ext_type)){
                            $this->Flash->error(__('Image file format not allowed'));
                        }
                        elseif(!move_uploaded_file($tmp_name,$filename)){
                            $this->Flash->error(__('Tag image could not be uploaded'));
                        }else{
                            $oldfile=$tag->cover_image;
                            $this->Tags->patchEntity($tag, ['cover_image'=>'/'.$filename]);
                            if($this->Tags->save($tag)) {
                                if($oldfile && file_exists('webroot'.$oldfile)){
                                    unlink('webroot'.$oldfile);
                                }
                                $this->Flash->success(__('Your tag has been updated.'.$tag->cover_image));
                                return $this->redirect(['action' => 'tags']); 
                            }else{
                                unlink($filename);
                            }
                        }
                    }
                }else{
                    if($this->Tags->save($tag)) {
                        $this->Flash->success(__('Your tag has been updated.'));
                        return $this->redirect(['action' => 'tags']); 
                    }
                    $this->Flash->error(__('Unable to update your tag.'));
                }
            }
        }
        $this->set('tag', $tag);
    }
    
    public function deleteTag($id){
        $this->request->allowMethod(['post', 'delete', 'get']);

        $tag = $this->Tags->find()
        ->where(['id'=>$id])
        ->firstOrFail();
        if ($this->Tags->delete($tag)) {
            $this->Flash->success(__('The '.$tag->id.' tag has been deleted.', $tag->title));
            return $this->redirect(['action' => 'tags']);
        }
    }
    public function category($id){
        $category = $this->Categories->find()
        ->where(['id'=>$id])
        ->firstOrFail();
        $this->set(compact('category'));
    }
    public function categories(){
        $this->loadComponent('Paginator');
        $query=$this->Categories->find();
        $categories = $this->Paginator->paginate($query);
        $this->set(compact('categories'));
    }
    public function addCategory(){
        $category = $this->Categories->newEmptyEntity();
        if ($this->request->is('post')) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            $against_title= $this->Categories
            ->find()
            ->where(['title' => $category->title])
            ->first();
            if($against_title && $category->id!=$against_title->id){
                $this->Flash->error(__('Category with this title already exist'));
            }else{
                $uploads_dir = 'uploads/categories/';
                if(!file_exists($uploads_dir)){
                    mkdir($uploads_dir,0777,true);
                }
                if(isset($_FILES["picture"])){ 
                    $ext_type = array('gif','jpg','jpe','jpeg','png');
                    $error=$_FILES["picture"]["error"];
                    if ($error == UPLOAD_ERR_OK) {
                        $tmp_name = $_FILES["picture"]["tmp_name"];
                        // basename() may prevent filesystem traversal attacks;
                        // further validation/sanitation of the filename may be appropriate
                        $name = basename($_FILES["picture"]["name"]);
                        $ext= pathinfo($name,PATHINFO_EXTENSION);
                        
                        $filename=$uploads_dir.md5(microtime(true)).".{$ext}";
                        if(!$ext || !in_array(strtolower($ext),$ext_type)){
                            $this->Flash->error(__('Image file format not allowed'));
                        }
                        elseif(!move_uploaded_file($tmp_name,$filename)){
                            $this->Flash->error(__('Category image could not be uploaded'));
                        }else{
                            $oldfile=$category->cover_image;
                            $this->Categories->patchEntity($category, ['cover_image'=>'/'.$filename]);
                            if($this->Categories->save($category)) {
                                if($oldfile && file_exists('webroot'.$oldfile)){
                                    unlink('webroot'.$oldfile);
                                }
                                $this->Flash->success(__('Your category has been saved.'.$category->cover_image));
                                return $this->redirect(['action' => 'categories']); 
                            }else{
                                unlink($filename);
                            }
                        }
                    }
                }else{
                    if($this->Categories->save($category)) {
                        $this->Flash->success(__('Your category has been saved.'));
                        return $this->redirect(['action' => 'categories']); 
                    }
                    $this->Flash->error(__('Unable to save your category.'));
                }
            }
        }
        $this->set('category', $category);
    }
   
    public function editCategory($id){
        $category = $this->Categories->find()
        ->where(['id'=>$id])
        ->firstOrFail();

        if ($this->request->is(['post', 'put'])) {
            $this->Categories->patchEntity($category, $this->request->getData());
            $against_title= $this->Categories
            ->find()
            ->where(['title' => $category->title])
            ->first();
            if($against_title && $category->id!=$against_title->id){
                $this->Flash->error(__('Category with this title already exist'));
            }else{
                $uploads_dir = 'uploads/categories/';
                if(!file_exists($uploads_dir)){
                    mkdir($uploads_dir,0777,true);
                }
                if(isset($_FILES["picture"])){ 
                    $ext_type = array('gif','jpg','jpe','jpeg','png');
                    $error=$_FILES["picture"]["error"];
                    if ($error == UPLOAD_ERR_OK) {
                        $tmp_name = $_FILES["picture"]["tmp_name"];
                        // basename() may prevent filesystem traversal attacks;
                        // further validation/sanitation of the filename may be appropriate
                        $name = basename($_FILES["picture"]["name"]);
                        $ext= pathinfo($name,PATHINFO_EXTENSION);
                        
                        $filename=$uploads_dir.md5(microtime(true)).".{$ext}";
                        if(!$ext || !in_array(strtolower($ext),$ext_type)){
                            $this->Flash->error(__('Image file format not allowed'));
                        }
                        elseif(!move_uploaded_file($tmp_name,$filename)){
                            $this->Flash->error(__('Category image could not be uploaded'));
                        }else{
                            $oldfile=$category->cover_image;
                            $this->Categories->patchEntity($category, ['cover_image'=>'/'.$filename]);
                            if($this->Categories->save($category)) {
                                if($oldfile && file_exists('webroot'.$oldfile)){
                                    unlink('webroot'.$oldfile);
                                }
                                $this->Flash->success(__('Your category has been updated.'.$category->cover_image));
                                return $this->redirect(['action' => 'categories']); 
                            }else{
                                unlink($filename);
                            }
                        }
                    }
                }else{
                    if($this->Categories->save($category)) {
                        $this->Flash->success(__('Your category has been updated.'));
                        return $this->redirect(['action' => 'categories']); 
                    }
                    $this->Flash->error(__('Unable to update your category.'));
                }
            }
        }
        $this->set('category', $category);
    }
    
    public function deleteCategory($id){
        $this->request->allowMethod(['post', 'delete', 'get']);

        $category = $this->Categories->find()
        ->where(['id'=>$id])
        ->firstOrFail();
        if ($this->Categories->delete($category)) {
            $this->Flash->success(__('The '.$category->id.' category has been deleted.', $category->title));
            return $this->redirect(['action' => 'categories']);
        }
    }
    public function user($id){
        $user = $this->Users
        ->find()
        ->where(['id' => $id])
        ->firstOrFail();
        $this->set(compact('user'));
    }
    public function users(){
        $this->loadComponent('Paginator');
        $users = $this->Paginator->paginate($this->Users->find());
        $this->set(compact('users'));
    }
    
    public function addUser(){
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $against_email = $this->Users
            ->find()
            ->where(['email' => $user->email])
            ->first();
            $against_username= $this->Users
            ->find()
            ->where(['username' => $user->username])
            ->first();
            if($against_email && $user->id!=$against_email->id){
                $this->Flash->error(__('Email already taken'));
            }
            elseif($against_username && $user->id!=$against_username->id){
                $this->Flash->error(__('Username already taken'));
            }elseif(!$this->Identity->get('admin')){
               $this->Flash->error(__('Access denied'));
            }else{
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('User has been saved.'));
                    return $this->redirect(['action' => 'users']);
                }
                $this->Flash->error(__('Unable to add new user.'));
            }
        }
        $this->set('user', $user);
    }
    public function editUser($id){
        $user = $this->Users
        ->find()
        ->where(['id' => $id])
        ->firstOrFail();
        if ($this->request->is(['post', 'put'])) {
            $this->Users->patchEntity($user, $this->request->getData());
            $against_email= $this->Users
            ->find()
            ->where(['email' => $user->email])
            ->first();
            $against_username = $this->Users
            ->find()
            ->where(['username' => $user->username])
            ->first();
            if($against_email && $user->id!=$against_email->id){
                $this->Flash->error(__('Email already taken'));
            }
            elseif($against_username && $user->id!=$against_username->id){
                $this->Flash->error(__('Username already taken'));
            }elseif(!($this->Identity->get('admin'))){
                $this->Flash->error(__($this->Identity->get('username').' your account is denied'));
            }
            else{
                if($this->Users->save($user)) {
                    $this->Flash->success(__('User has been updated.'));
                    return $this->redirect(['action' => 'users']);
                }
                $this->Flash->error(__('Unable to update user.'));
            }
        }

        $this->set('user', $user);
    }
    public function deleteUser($id){
        $this->request->allowMethod(['post', 'delete', 'get']);
        $user = $this->Users->find('all',['id'=>$id])->firstOrFail();
        if(!$this->Identity->get('admin')){
            $this->Flash->error(__('Access denied'));
        }
         else{
            if ($this->Users->delete($user)) {
                $this->Flash->success(__('The '.$id.' user has been deleted.', $user->username));
                return $this->redirect(['action' => 'users']);
            }
        }
    }
    public function transferOwnership($id){
        $this->request->allowMethod(['post', 'put', 'get']);
        $new_owner = $this->Users->find()->where(['id'=>$id])->firstOrFail();
        $old_owner = $this->Users->find()->where(['owner'=>1])->firstOrFail();
        $this->Users->patchEntity($new_owner, ['owner'=>1,'admin'=>1]);
        $this->Users->patchEntity($old_owner, ['owner'=> 0]);
        if(!$this->Identity->get('owner')){
            $this->Flash->error(__('Access denied'));
            return $this->redirect(['action' => 'users']);
        }else{
            if ($this->Users->save($new_owner)) {
                $this->Users->save($old_owner);
                $this->Flash->success(__($new_owner->username.' is now known as owner.', $new_owner->description));
                return $this->redirect(['action' => 'logout']);
            }
        }
    }
    public function disableUser($id){
        $this->request->allowMethod(['post', 'put', 'get']);
        $user = $this->Users->find()->where(['id'=>$id])->firstOrFail();
        if(!$this->Identity->get('admin')){
            $this->Flash->error(__('Access denied'));
            return $this->redirect(['action' => 'users']);
        }elseif($user->owner){
            $this->Flash->error(__('Access denied'));
            return $this->redirect(['action' => 'users']);
        }
        else{
            $this->Users->patchEntity($user, ['active'=>0]);
            if ($this->Users->save($user)) {
                $this->Flash->success(__($user->username.' is now known as owner.', $user->description));
                return $this->redirect(['action' => 'users']);
            }
        }
    }
    public function enableUser($id){
        $this->request->allowMethod(['post', 'put', 'get']);
        $user = $this->Users->find()->where(['id'=>$id])->firstOrFail();
        if(!$this->Identity->get('admin')){
            $this->Flash->error(__('Access denied'));
            return $this->redirect(['action' => 'users']);
        }elseif($user->owner){
            $this->Flash->error(__('Access denied'));
            return $this->redirect(['action' => 'users']);
        }
        else{
            $this->Users->patchEntity($user, ['active'=>1]);
            if ($this->Users->save($user)) {
                $this->Flash->success(__($user->username.' is now known as owner.', $user->description));
                return $this->redirect(['action' => 'users']);
            }
        }
    }
    public function logout()
    {
        $this->Authentication->logout();
        return $this->redirect(['controller' => 'Dashboard', 'action' => 'login']);
    }
    public function login()
    {
        $result = $this->Authentication->getResult();
        $user = $this->Users->newEmptyEntity();
        // If the user is logged in send them away.
        if ($result->isValid()) {
            if(!$this->Identity->get('active'))
            { 
                $this->Flash->error('Your account has been disables');
                $this->Authentication->logout();
            }
            else{
                $target = $this->Authentication->getLoginRedirect() ?? '/dashboard';
                return $this->redirect($target);
            }
           
        }
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error('Invalid username or password');
            $user = $this->Users->patchEntity($user, $this->request->getData());
        }
        $this->set('user', $user);
    }
}