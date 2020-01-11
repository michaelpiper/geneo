

<section class="home-about-area pt-10">
    <div class=" wrapper d-flex align-items-stretch">
        <?php require __DIR__."/sidebar.inc.php"?>
        <div id="content" class="p-4 p-md-5 pt-5">
            <br/>
            <h1>Profile</h1>
            <div class="mx-5">
                <?php
                echo  $this->Identity->get('email');
                ?>
            </div>
        </div>
    </div>
</section>