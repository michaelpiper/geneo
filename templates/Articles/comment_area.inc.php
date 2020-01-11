<div class="comments-area">
<h4><?= count($comments)?> Comments</h4>
<?php foreach($comments as $comm):?>
<div class="comment-list left-padding">
<div class="single-comment justify-content-between d-flex">
<div class="user justify-content-between d-flex">
<div class="thumb">
<img src="/img/blog/c3.jpg" alt="">
</div>
<div class="desc">
<h5><a href="#"><?= $comm->name?></a></h5>
<p class="date"><?= $comm->created->format(DATE_RFC850)?></p>
<p class="comment">
<?= $comm->message?>
</p>
 </div>
</div>
<div class="reply-btn">
<a href="" class="btn-reply text-uppercase">reply</a>
</div>
</div>
</div>
<?php endforeach;?>
</div>
<div class="comment-form">
<h4>Leave a Comment</h4>
<?= $this->Flash->render() ?>
    <?= $this->Form->create($comment)?>
    <?= $this->Form->control('_action', ['type' => 'hidden', 'value' => 'comment'])?>
<div class="form-group form-inline">
<div class="form-group col-lg-6 col-md-12 name">
<input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" onfocus="if (!window.__cfRLUnblockHandlers) return false; this.placeholder = ''" onblur="if (!window.__cfRLUnblockHandlers) return false; this.placeholder = 'Enter Name'" data-cf-modified-6281b50d504efa744af9ec77-="">
</div>
<div class="form-group col-lg-6 col-md-12 email">
<input type="email" name="email" class="form-control" id="email" placeholder="Enter email address" onfocus="if (!window.__cfRLUnblockHandlers) return false; this.placeholder = ''" onblur="if (!window.__cfRLUnblockHandlers) return false; this.placeholder = 'Enter email address'" data-cf-modified-6281b50d504efa744af9ec77-="">
</div>
</div>
<div class="form-group">
<input type="text" name="subject" class="form-control" id="subject" placeholder="Subject" onfocus="if (!window.__cfRLUnblockHandlers) return false; this.placeholder = ''" onblur="if (!window.__cfRLUnblockHandlers) return false; this.placeholder = 'Subject'" data-cf-modified-6281b50d504efa744af9ec77-="">
</div>
<div class="form-group">
<textarea class="form-control mb-10" rows="5" name="message" placeholder="Messege" onfocus="if (!window.__cfRLUnblockHandlers) return false; this.placeholder = ''" onblur="if (!window.__cfRLUnblockHandlers) return false; this.placeholder = 'Messege'" required="" data-cf-modified-6281b50d504efa744af9ec77-=""></textarea>
</div>
<?= $this->Form->button(__('Post Comment'),['class'=>'primary-btn text-uppercase'])?>
<?= $this->Form->end()?>
</div>
</div>