<section class="home-about-area pt-10">
    <div class=" wrapper d-flex align-items-stretch">
        <?php require __DIR__."/sidebar.inc.php"?>
        <div id="content" class="p-4 p-md-5 pt-5 w-100">
            <img class="img-fluid img-preview" style="max-height:300px;height:300px;width:100%;" src="<?= isset($category->cover_image) ? $category->cover_image:'/img/placeholder.png' ?>" alt="">

            <br/>
            <h1><?=$category->title?> </h1><span class="text-right"><?= $category->created->format(DATE_RFC850) ?></span>
            <hr>
            <br/>
            <p>Description: <?=$category->description?></p>
        </div>
    </div>
</section>