<section class="home-about-area pt-10">
    <div class=" wrapper d-flex align-items-stretch">
        <?php require __DIR__."/sidebar.inc.php"?>
        <div id="content" class="p-4 p-md-5 pt-5">
            <br/>
            <h1>Edit Profile</h1>
            <div class="mx-5">
            <?= $this->Flash->render() ?>
            <img class="img-fluid img-preview rounded-circle" onclick="$('#picture').click()" style="max-height:300px;height:300px;width:300px;" src="<?= isset($user->display_image) ? $user->display_image:'/img/placeholder.png' ?>" alt="">

            <?php

                echo $this->Form->create($user,['type' => 'file']);
                // Hard code the user for now.
                echo $this->Form->control('picture', ['type' => 'file', 'style'=>'display:none;','onchange'=>'readURL(this,\'/img/placeholder.png\');'],['style'=>'display:none;']);
                echo $this->Form->control('email',['placeholder'=>'Email']);
                echo $this->Form->control('username', ['placeholder'=>'Username','type'=>'text']);
                echo $this->Form->control('description', ['rows' => '3']);
                echo $this->Form->button(__('Edit Profile'));
                echo $this->Form->end();
            ?>
            </div>
        </div>
    </div>
</section>