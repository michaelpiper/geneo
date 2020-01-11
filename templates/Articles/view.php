<!-- File: templates/Articles/view.php -->

<section class="relative about-banner">
<div class="overlay overlay-bg"></div>
<div class="container">
<div class="row d-flex align-items-center justify-content-center">
<div class="about-content col-lg-12">
<h1 class="text-white">
<?=$article->title?>
</h1>
<p class="text-white link-nav"><a href="/">Home </a> <span class="lnr lnr-arrow-right"></span><a href="/articles">Blog </a> <span class="lnr lnr-arrow-right"></span> <a href="/articles/view/<?=$article->slug?>"><?=$article->title?></a></p>
</div>
</div>
</div>
</section>


<section class="post-content-area single-post-area">
<div class="container">
<div class="row">
<div class="col-lg-8 posts-list">
<div class="single-post row">
<div class="col-lg-12">
<div class="feature-img">
<img class="img-fluid" src="/img/blog/feature-img1.jpg" alt="">
</div>
</div>
<div class="col-lg-3  col-md-3 meta-details">
<ul class="tags">
<li><a href="#">Food,</a></li>
<li><a href="#">Technology,</a></li>
<li><a href="#">Politics,</a></li>
<li><a href="#">Lifestyle</a></li>
</ul>
<div class="user-details row">
<p class="user-name col-lg-12 col-md-12 col-6"><a href="#">Mark wiens</a> <span class="lnr lnr-user"></span></p>
<p class="date col-lg-12 col-md-12 col-6"><a href="#">12 Dec, 2017</a> <span class="lnr lnr-calendar-full"></span></p>
<p class="view col-lg-12 col-md-12 col-6"><a href="#">1.2M Views</a> <span class="lnr lnr-eye"></span></p>
<p class="comments col-lg-12 col-md-12 col-6"><a href="#">06 Comments</a> <span class="lnr lnr-bubble"></span></p>
<ul class="social-links col-lg-12 col-md-12 col-6">
<li><a href="#"><i class="fa fa-facebook"></i></a></li>
<li><a href="#"><i class="fa fa-twitter"></i></a></li>
<li><a href="#"><i class="fa fa-github"></i></a></li>
<li><a href="#"><i class="fa fa-behance"></i></a></li>
</ul>
</div>
</div>
<div class="col-lg-9 col-md-9">
<h3 class="mt-20 mb-20"><?=$article->title?></h3>
<?=$article->body?>
 <?= print_r($article)?>
</div>
</div>
<!-- include next article-->
<?php require __DIR__."/next_article.inc.php";?>

<!-- include comment area -->
<?php require __DIR__."/comment_area.inc.php";?>



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
<?php require_once __DIR__.'/../components/footer.inc.php'?>
