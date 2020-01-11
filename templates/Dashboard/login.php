
<section class="banner-area">
    <div class="container">
    </div>
</section>

<section class="home-about-area pt-120">
    <div class="container">
        please login
        <h1>Administrator</h1>
        <div class="mx-5">
        <?= $this->Flash->render() ?>
            <?php
            echo $this->Form->create($user);
            // Hard code the user for now.
            echo $this->Form->control('email', ['type' => 'email','placeholder'=>"email"]);
            echo $this->Form->control('password', ['type' => 'password','placeholder'=>"password"]);
            echo $this->Form->button(__('Login'));
            echo $this->Form->end();
            ?>
        </div>
    </div>
</section>