<div class="single-sidebar-widget tag-cloud-widget">
<h4 class="tagcloud-title">Tag Clouds</h4>
<ul>
<?php foreach($p_tags as $p_tag):?>
<li>
<a href="#">
<?= $p_tag->title?>
</a>
</li>
<?php endforeach; ?>

</ul>
</div>