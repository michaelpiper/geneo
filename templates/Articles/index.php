<?php require_once __DIR__.'/most_viewed.inc.php'?>
<section class="top-category-widget-area pt-90 pb-90 ">
<div class="container">
<div class="row">
<?php foreach($p_categories as $p_cat_key=>$p_category):?>
    <?php if($p_cat_key==3)break;?>
    <div class="col-lg-4">
    <div class="single-cat-widget">
    <div class="content relative">
    <div class="overlay overlay-bg"></div>
    <a href="#" target="_blank">
    <div class="thumb">
    <img class="content-image img-fluid d-block mx-auto" src="<?=$p_category->cover_image?>" alt="">
    </div>
    <div class="content-details">
    <h4 class="content-title mx-auto text-uppercase"><?=$p_category->title?></h4>
    <span></span>
    <p><?=$p_category->description?></p>
    </div>
    </a>
    </div>
    </div>
    </div>
   
<?php endforeach;?>
</div>
</div>
</section>


<section class="post-content-area">

<div class="container">
<div class="row">

<!-- inlcude post -->
<?php require __DIR__.'/post.inc.php';?>
<div class="col-lg-4 sidebar-widgets">
<div class="widget-wrap">
<div class="single-sidebar-widget search-widget">
<?= $this->Form->create(null,['method' => 'get','class'=>'search-form','action'=>'/articles/search'])?>
<input placeholder="Search Posts" name="q" value ="<?=  isset($_GET['q'])? $_GET['q']:''?>" type="text" onfocus="if (!window.__cfRLUnblockHandlers) return false; this.placeholder = ''" onblur="if (!window.__cfRLUnblockHandlers) return false; this.placeholder = 'Search Posts'" data-cf-modified-3f8121ceb2232c04620066d3-="">
<button type="submit"><i class="fa fa-search"></i></button>
<?= $this->Form->end()?>
</div>

<!-- import senior author -->
<?php require __DIR__.'/senior_author.inc.php';?>
<!-- popular post -->
<?php require __DIR__.'/popular_post.inc.php';?>

<!-- ad banner -->
<?php require __DIR__.'/ad_banner.inc.php';?>
<!-- post categories -->
<?php require __DIR__.'/categories.inc.php';?>

<div class="single-sidebar-widget newsletter-widget">
<h4 class="newsletter-title">Newsletter</h4>
<p>
Here, I focus on a range of items and features that we use in life without
giving them a second thought.
</p>
<div class="form-group d-flex flex-row">
<div class="col-autos">
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i>
</div>
</div>
<input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Enter email" onfocus="if (!window.__cfRLUnblockHandlers) return false; this.placeholder = ''" onblur="if (!window.__cfRLUnblockHandlers) return false; this.placeholder = 'Enter email'" data-cf-modified-3f8121ceb2232c04620066d3-="">
</div>
</div>
<a href="#" class="bbtns">Subcribe</a>
</div>
<p class="text-bottom">
You can unsubscribe at any time
</p>
</div>
<!-- tags -->
<?php require __DIR__.'/tags.inc.php';?>

</div>
</div>
</div>
</div>
</section>
