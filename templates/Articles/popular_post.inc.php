<div class="single-sidebar-widget popular-post-widget">
<h4 class="popular-title">Popular Posts</h4>

<div class="popular-post-list">
<?php foreach ($popular_articles as $p_a_key=>$popular_article): ?>
    <?php if($p_a_key==4)break;?>
<div class="single-post-list d-flex flex-row align-items-center">
<?php if( $popular_article->cover_image):?>
<div class="thumb">
<img class="img-fluid" width="80px" height="80px" src="<?=$popular_article->cover_image?>" alt="">
</div>
<?php endif;?>
<div class="details">
<a href="blog-single.html"><h6><?=$popular_article->title?></h6></a>
<p><?=$popular_article->created->format(DATE_RFC850)?></p>
</div>
</div>

<?php endforeach; ?>
</div>
</div>