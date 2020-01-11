<div class="single-sidebar-widget post-category-widget">
<h4 class="category-title">Post Catgories</h4>
<ul class="cat-list">
<?php foreach($p_categories as $p_category):?>
<li>
<a href="#" class="d-flex justify-content-between">
<p><?= $p_category->title?></p>
<p>37</p>
</a>
</li>
<?php endforeach; ?>
</ul>
</div>