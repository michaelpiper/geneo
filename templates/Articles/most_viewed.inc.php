<!-- File: templates/Articles/index.php -->

<section class="banner-area relative blog-home-banner" id="home">
    <div class="overlay overlay-bg"></div>
    <div class="container">
    <div class="row d-flex align-items-center justify-content-center">
    <div class="about-content blog-header-content col-lg-12">
    <h1 class="text-white">
    <?=$mostViewed->title?>
    </h1>
    <p class="text-white">
    <?=$mostViewed->body?>
    </p>
    <?= $this->Html->link('View More', ['action' => 'view', $mostViewed->slug],['class'=>'primary-btn']) ?></h3>
    </div>
    </div>
    </div>
</section>