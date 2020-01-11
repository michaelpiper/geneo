<section class="home-about-area pt-10">
    <div class=" wrapper d-flex align-items-stretch">
        <?php require __DIR__."/sidebar.inc.php"?>
        <div id="content" class="p-4 p-md-5 pt-5">
            <br/>
            <h1>Edit Users</h1>
            <div class="mx-5">
            <?= $this->Flash->render() ?>
            <?php
                echo $this->Form->create($user);
                // Hard code the user for now.
                echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => $user->id]);
                echo $this->Form->control('email',['placeholder'=>'Email']);
                echo $this->Form->control('username', ['placeholder'=>'Username','type'=>'text']);
                echo $this->Form->control('description', ['rows' => '3']);
                echo $this->Form->control('admin', ['type' => 'checkbox']);
                echo $this->Form->button(__('Edit User'));
                echo $this->Form->end();
            ?>
            </div>
        </div>
    </div>
</section>