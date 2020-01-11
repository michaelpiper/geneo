<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.10.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->disableAutoLayout();

$cakeDescription = 'CakePHP: project';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.1/normalize.css">

    <?= $this->Html->css('milligram.min.css') ?>
    <?= $this->Html->css('cake.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="shortcut icon" href="img/fav.png">

<meta name="author" content="colorlib">

<meta name="description" content="">

<meta name="keywords" content="">

<meta charset="UTF-8">

<title>Personal</title>
<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">

<link rel="stylesheet" href="/css/linearicons.css">
<link rel="stylesheet" href="/css/font-awesome.min.css">
<link rel="stylesheet" href="/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

<link rel="stylesheet" href="/css/bootstrap.css">

<link rel="stylesheet" href="/css/magnific-popup.css">
<link rel="stylesheet" href="/css/jquery-ui.css">
<link rel="stylesheet" href="/css/nice-select.css">
<link rel="stylesheet" href="/css/animate.min.css">
<link rel="stylesheet" href="/css/owl.carousel.css">
<link rel="stylesheet" href="/css/main.css">
<link rel="stylesheet" src="/css/dashboard.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
</head>
<body>
    <header id="header">
        <div class="container main-menu">
        <div class="row align-items-center justify-content-between d-flex">
        <div id="logo">
        <a href="index.html"><img src="/img/logo.png" alt="" title="" /></a>
        </div>
        <nav id="nav-menu-container">
        <ul class="nav-menu">
        <li><a href="/">Home</a></li>
        <li><a href="/about">About</a></li>
        <li><a href="/articles">Blog</a></li>
        <?php if ($this->Identity->isLoggedIn()) :?>
            <li><a href="/dashboard">Dashboard</a></li>
            <li><a href="/dashboard/logout">Logout</a></li>
        <?php else : ?>
            <li><a href="/dashboard/login">Login</a></li>

        <?php endif;?>
        
        <li><a href="/contact">Contact</a></li>
        </ul>
        </nav>
        </div>
        </div>
    </header>
    <main class="main">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </main>
    <?php if(isset($_SERVER['REQUEST_URI']) && !preg_match('/dashboard\/login/i',$_SERVER['REQUEST_URI'])):?>
    <?php require_once __DIR__.'/../components/footer.inc.php'?>
    <?php endif;?>
    <script src="/js/vendor/jquery-2.2.4.min.js" type="cef186f2bb98cf3c1699c485-text/javascript"></script>
    <script src="/js/popper.min.js" type="cef186f2bb98cf3c1699c485-text/javascript"></script>
    <script src="/js/vendor/bootstrap.min.js" type="cef186f2bb98cf3c1699c485-text/javascript"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA" type="cef186f2bb98cf3c1699c485-text/javascript"></script>
    <script src="/js/easing.min.js" type="cef186f2bb98cf3c1699c485-text/javascript"></script>
    <script src="/js/hoverIntent.js" type="cef186f2bb98cf3c1699c485-text/javascript"></script>
    <script src="/js/superfish.min.js" type="cef186f2bb98cf3c1699c485-text/javascript"></script>
    <script src="/js/jquery.ajaxchimp.min.js" type="cef186f2bb98cf3c1699c485-text/javascript"></script>
    <script src="/js/jquery.magnific-popup.min.js" type="cef186f2bb98cf3c1699c485-text/javascript"></script>
    <script src="/js/jquery.tabs.min.js" type="cef186f2bb98cf3c1699c485-text/javascript"></script>
    <script src="/js/jquery.nice-select.min.js" type="cef186f2bb98cf3c1699c485-text/javascript"></script>
    <script src="/js/isotope.pkgd.min.js" type="cef186f2bb98cf3c1699c485-text/javascript"></script>
    <script src="/js/waypoints.min.js" type="cef186f2bb98cf3c1699c485-text/javascript"></script>
    <script src="/js/jquery.counterup.min.js" type="cef186f2bb98cf3c1699c485-text/javascript"></script>
    <script src="/js/simple-skillbar.js" type="cef186f2bb98cf3c1699c485-text/javascript"></script>
    <script src="/js/owl.carousel.min.js" type="cef186f2bb98cf3c1699c485-text/javascript"></script>
    <script src="/js/mail-script.js" type="cef186f2bb98cf3c1699c485-text/javascript"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="cef186f2bb98cf3c1699c485-text/javascript"></script>
    <script src="/js/main.js" type="cef186f2bb98cf3c1699c485-text/javascript"></script>
    <script src="/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="cef186f2bb98cf3c1699c485-text/javascript"></script>
    <script type="cef186f2bb98cf3c1699c485-text/javascript">
        $(".texteditor-load").wysihtml5();
    </script>
    <style>
        .texteditor-load{
            height:400px;
        }
    </style>
    <script src="/js/readurl.js" type="cef186f2bb98cf3c1699c485-text/javascript"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" type="cef186f2bb98cf3c1699c485-text/javascript"></script>
    <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="cef186f2bb98cf3c1699c485-|49" defer=""></script>
</body>
</html>
