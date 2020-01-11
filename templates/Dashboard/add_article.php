
<section class="home-about-area pt-10">
    <div class=" wrapper d-flex align-items-stretch">
        <?php require __DIR__."/sidebar.inc.php"?>
        <div id="content" class="p-4 p-md-5 pt-5">
           <br/>
            <h1>Add Articles</h1>
            <div class="mx-5">
            <?= $this->Flash->render() ?>
            <img class="img-fluid img-preview" onclick="$('#picture').click()" style="max-height:300px;height:300px;" src="<?= isset($article->cover_image) ? $article->cover_image:'/img/placeholder.png' ?>" alt="">
            <?php
                echo $this->Form->create($article,['type' => 'file']);
                // Hard code the user for now.
                echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => $this->Identity->get('id')]);
                echo $this->Form->control('picture', ['type' => 'file', 'style'=>'display:none;','onchange'=>'readURL(this,\'/img/placeholder.png\');']);
                echo $this->Form->control('title',['placeholder'=>'Title','type'=>'text']);
                echo $this->Form->control('body', ['rows' => '3']);
                echo $this->Form->control('category', ['name'=>'category_id','type' => 'select','options'=>$categories]);
                echo"<p> Do you  want to publish article immediately?</p>";
                echo $this->Form->control('published', ['type' => 'checkbox','value'=>1]);
                echo $this->Form->button(__('Save Article'));
                echo $this->Form->end();
            ?>
            </div>
        </div>
    </div>
</section>