
<nav id="sidebar" class="img bg-dark" style="background-image: url(/images/bg_1.jpg);">
<div class="p-4" style="width:220px;">
    <br/>
    <br/>
<h4 class="pt-4"><a href="/dashboard" class="logo"><?=$this->Identity->get('username')?></a></h4>
<ul class="list-unstyled components mb-5">
<li class="active">
<a href="/dashboard/profile"><span class="fa fa-home mr-3"></span> Profile</a>
</li>
<?php if($this->Identity->get('admin')):?>
<li>
<a href="/dashboard/users"><span class="fa fa-sticky-note mr-3"></span> Users</a>
</li>
<?php endif?>
<li>

<a href="/dashboard/articles"><span class="fa fa-user mr-3"></span> Articles</a>
</li>

<li>
<a href="/dashboard/tags"><span class="fa fa-paper-plane mr-3"></span> Articles tags</a>
</li>
<li>
<a href="/dashboard/categories"><span class="fa fa-user mr-3"></span> Articles categories</a>
</li>

<li>
<a href="/dashboard/change-password"><span class="fa fa-cogs mr-3"></span> Change password</a>
</li>
<li>
<a href="/dashboard/logout"><span class="fa fa-sign-out mr-3"></span> Logout</a>
</li>
</ul>
<div class="mb-5">
<h3 class="h6 mb-3">Subscribe for newsletter</h3>
<form action="#" class="subscribe-form">
<div class="form-group d-flex">
<div class="icon"><span class="icon-paper-plane"></span></div>
<input type="text" class="form-control" placeholder="Enter Email Address">
</div>
</form>
</div>
<div class="footer">
<p>
Copyright &copy;<script type="cd980b7082d91136477ff365-text/javascript">document.write(new Date().getFullYear());</script> All rights reserved | created  by <a href="https://mpstudio.com.ng" target="_blank">Michael Piper</a>
</p>
</div>
</div>
</nav>
