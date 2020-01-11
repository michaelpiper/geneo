<section class="home-about-area pt-10">
    <div class=" wrapper d-flex align-items-stretch">
        <?php require __DIR__."/sidebar.inc.php"?>
        <div id="content" class="p-4 p-md-5 pt-5">
            <br/>
            <h1>Change password</h1>
            <div class="mx-5">
                <?= $this->Flash->render() ?>
                <?php
                echo $this->Form->create($user);
                // Hard code the user for now.
                echo $this->Form->control('current_password', ['type' => 'password','placeholder'=>"current password"]);
                echo $this->Form->control('new_password', ['type' => 'password','placeholder'=>"new password"]);
                echo $this->Form->control('confirm_password', ['type' => 'password','placeholder'=>"confirm password"]);
                echo $this->Form->button(__('Change'));
                echo $this->Form->end();
                ?>
            </div>
        </div>
    </div>
</section>