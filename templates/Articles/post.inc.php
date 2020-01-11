<div class="col-lg-8 posts-list">

<?php foreach ($articles as $article): ?>
<?php $author=$Users->find()->where(['id'=>$article->user_id])->first();?>
       
<div class="single-post row">
<div class="col-lg-3  col-md-3 meta-details">
<ul class="tags">
<li><a href="#">Food,</a></li>
<li><a href="#">Technology,</a></li>
<li><a href="#">Politics,</a></li>
<li><a href="#">Lifestyle</a></li>
</ul>
<div class="user-details row">
<p class="user-name col-lg-12 col-md-12 col-6"><a href="#"><?=$author->username?></a> <span class="lnr lnr-user"></span></p>
<p class="date col-lg-12 col-md-12 col-6"><a href="#"><?= $article->created->format(DATE_RFC850) ?></a> <span class="lnr lnr-calendar-full"></span></p>
<p class="view col-lg-12 col-md-12 col-6"><a href="#"><?= $article->viewed ?> Views</a> <span class="lnr lnr-eye"></span></p>
<p class="comments col-lg-12 col-md-12 col-6"><a href="#"><?=mt_rand(2,88) ?> Comments</a> <span class="lnr lnr-bubble"></span></p>
</div>
</div>
<div class="col-lg-9 col-md-9 ">
<div class="feature-img">
<img class="img-fluid" src="<?=($article->cover_image)?$article->cover_image:'/image/cover_image.png'?>" alt="">
</div>
<h3> <?= $this->Html->link($article->title, ['action' => 'view', $article->slug],['class'=>'posts-title','style'=>"color:#000;"]) ?></h3>
<p class="excert"> <?= substr($article->body,0,300)?>...</p>
<?= $this->Html->link('View More', ['action' => 'view', $article->slug],['class'=>'primary-btn']) ?></h3>
</div>
</div>

<?php endforeach; ?>
<?php if (count($articles)==0): ?>
<h1 class="text-center">post list empty</h1>
<?php else:?>
<nav class="blog-pagination justify-content-center d-flex">
<ul class="pagination">
<li class="page-item">
<a href="#" class="page-link" aria-label="Previous">
<span aria-hidden="true">
<span class="lnr lnr-chevron-left"></span>
</span>
</a>
</li>
<?= $this->Paginator->numbers()?>
<?php $k=mt_rand(1,5);$l=5;foreach (range(1,$l) as $page): ?>
<li class="page-item <?=$k==$page?'active':''?>"><a href="#" class="page-link"><?=$page?></a></li>
<?php endforeach; ?>
<a href="#" class="page-link" aria-label="Next">
<span aria-hidden="true">
<span class="lnr lnr-chevron-right"></span>
</span>
</a>
</li>
</ul>
</nav>
<?php endif;?>
</div>