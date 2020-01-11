
<section class="home-about-area pt-10">
    <div class=" wrapper d-flex align-items-stretch">
        <?php require __DIR__."/sidebar.inc.php"?>
        <div id="content" class="p-4 p-md-5 pt-5">
            <br/>
            <h1>Edit Tags</h1>
            <div class="mx-5">
            <?= $this->Flash->render() ?>
            <img class="img-fluid img-preview" onclick="$('#picture').click()" style="max-height:300px;height:300px;" src="<?= isset($tag->cover_image) ? $tag->cover_image:'/img/placeholder.png' ?>" alt="">

            <?php
                echo $this->Form->create($tag,['type' => 'file']);
                // Hard code the user for now.
                echo $this->Form->control('picture', ['type' => 'file', 'style'=>'display:none;','onchange'=>'readURL(this,\'/img/placeholder.png\');'],['style'=>'display:none;']);
                echo $this->Form->control('title',['placeholder'=>'Title','type'=>'text']);
                echo $this->Form->control('description', ['rows' => '3']);
                echo $this->Form->button(__('Edit Tag'));
                echo $this->Form->end();
            ?>
            </div>
        </div>
    </div>
</section>