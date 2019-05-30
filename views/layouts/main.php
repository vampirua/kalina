<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <div role="banner" class="site-navbar wrap">
        <div class="site-navbar-top">
            <div class="container">
                <div class="row align-items-center">

                    <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
                        <form action="" class="site-block-top-search">
                            <span class="icon icon-search2"></span>
                            <input type="text" class="form-control border-0" placeholder="Search">
                        </form>
                    </div>

                    <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
                        <div class="site-logo">
                            <?= Html::a('Shoppers', '/', ['class' => 'js-logo-clone']) ?>
                        </div>
                    </div>

                    <div class="col-6 col-md-4 order-3 order-md-3 text-right">
                        <div class="site-top-icons">
                            <ul>
                                <li><a href="#"><span class="icon icon-person"></span></a></li>
                                <li><a href="#"><span class="icon icon-heart-o"></span></a></li>
                                <li>
                                    <a href="/site/cart" class="site-cart">
                                        <span class="icon icon-shopping_cart"></span>
                                        <span class="count"><?=Yii::$app->cart->getCount();?></span>
                                    </a>
                                </li>
                                <li class="d-inline-block d-md-none ml-md-0">
                                    <a href="#" class="site-menu-toggle js-menu-toggle">
                                        <span class="icon-menu"></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <nav class="site-navigation text-right text-md-center" role="navigation">
            <div class="container">
                <ul class="site-menu js-clone-nav d-none d-md-block">
                    <li class="has-children active">
                        <?= Html::a('Головна', '/') ?>
                        <ul class="dropdown">
                            <li><a href="#">Menu One</a></li>
                            <li><a href="#">Menu Two</a></li>
                            <li><a href="#">Menu Three</a></li>
                            <li class="has-children">
                                <a href="#">Sub Menu</a>
                                <ul class="dropdown">
                                    <li><a href="#">Menu One</a></li>
                                    <li><a href="#">Menu Two</a></li>
                                    <li><a href="#">Menu Three</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="has-children">
                        <?= Html::a('Про нас', '/site/about') ?>
                        <ul class="dropdown">
                            <li><a href="#">Menu One</a></li>
                            <li><a href="#">Menu Two</a></li>
                            <li><a href="#">Menu Three</a></li>
                        </ul>
                    </li>
                    <li><?= Html::a('Каталог', '/site/catalog') ?>
                    <li><a href="#">Catalogue</a></li>
                    <li><a href="#">New Arrivals</a></li>
                    <li><?= Html::a('Контакт', '/site/contact') ?></li>
                </ul>
            </div>
        </nav>
    </div>
</head>
<body>
<?php $this->beginBody() ?>

<?= $content ?>
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="footer-heading mb-4">Navigations</h3>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <ul class="list-unstyled">
                            <li><a href="#">Sell online</a></li>
                            <li><a href="#">Features</a></li>
                            <li><a href="#">Shopping cart</a></li>
                            <li><a href="#">Store builder</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <ul class="list-unstyled">
                            <li><a href="#">Mobile commerce</a></li>
                            <li><a href="#">Dropshipping</a></li>
                            <li><a href="#">Website development</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <ul class="list-unstyled">
                            <li><a href="#">Point of sale</a></li>
                            <li><a href="#">Hardware</a></li>
                            <li><a href="#">Software</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                <h3 class="footer-heading mb-4">Promo</h3>
                <a href="#" class="block-6">
                    <img src="images/hero_1.jpg" alt="Image placeholder" class="img-fluid rounded mb-4">
                    <h3 class="font-weight-light  mb-0">Finding Your Perfect Shoes</h3>
                    <p>Promo from nuary 15 &mdash; 25, 2019</p>
                </a>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="block-5 mb-5">
                    <h3 class="footer-heading mb-4">Contact Info</h3>
                    <ul class="list-unstyled">
                        <li class="address">203 Fake St. Mountain View, San Francisco, California, USA</li>
                        <li class="phone"><a href="tel://23923929210">+2 392 3929 210</a></li>
                        <li class="email">emailaddress@domain.com</li>
                    </ul>
                </div>

                <div class="block-7">
                    <form action="#" method="post">
                        <label for="email_subscribe" class="footer-heading">Subscribe</label>
                        <div class="form-group">
                            <input type="text" class="form-control py-4" id="email_subscribe" placeholder="Email">
                            <input type="submit" class="btn btn-sm btn-primary" value="Send">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
