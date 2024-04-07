<?php
include_once('config/system.config.php');
session_start();
require_once('classes/categories.class.php');
$cat = new Categories();
$allCat = $cat->viewAllCategories();
?>
<!doctype html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        e-Installments </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="js/mycode.js"></script>

</head>

<body>
    <header>
        <!-- Header Start -->
        <div class="header-area">
            <div class="main-header header-sticky">
                <div class="container-fluid">
                    <div class="menu-wrapper">
                        <!-- Logo -->

                        <div class="logo">
                            <a class="text-dark" href="">
                                <span>

                                    <h2>
                                        <strong class="text-danger font-weight-bold"><?= SYS_TITLE_1HALF ?></strong>
                                        <?= SYS_TITLE_2HALF ?>
                                    </h2>
                                </span>
                            </a>
                        </div>

                        <!-- Main-menu -->
                        <div class="main-menu d-none d-lg-block">
                            <nav>
                                <ul id="navigation">
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="shop.php">shop</a></li>

                                    <li><a href="#">Categories</a>
                                        <ul class="submenu">
                                            <?php
                                            foreach ($allCat as $each) {
                                            ?>
                                                <li><a href="shop.php?filter=<?= $each['cat_id'] ?>"><?= $each['cat_Name'] ?></a></li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                    <?php
                                    $filter = "latest";
                                    ?>
                                    <li class="hot"><a href="shop.php?filter=<?= $filter ?>">Latest</a>
                                        <!-- <ul class="submenu">
                                                <li><a href="shop.php"> Product list</a></li>
                                                <li><a href="product_details.php"> Product Details</a></li>
                                            </ul> -->
                                    </li>
                                    <!-- <li><a href="blog.php">Blog</a>
                                            <ul class="submenu">
                                                <li><a href="blog.php">Blog</a></li>
                                                <li><a href="blog-details.php">Blog Details</a></li>
                                            </ul>
                                        </li> -->
                                    <!-- <li><a href="#">Pages</a>
                                            <ul class="submenu">
                                                <li><a href="login.php">Login</a></li>
                                                <li><a href="cart.php">Cart</a></li>
                                                <li><a href="elements.php">Element</a></li>
                                                <li><a href="confirmation.php">Confirmation</a></li>
                                                <li><a href="checkout.php">Product Checkout</a></li>
                                            </ul>
                                        </li> -->
                                    <li><a href="about.php">about</a></li>

                                    <li><a href="contact.php">Contact</a></li>
                                    <?php
                                    if (isset($_SESSION['Logged_in']) == true) {
                                    ?>
                                        <li><a href="cart.php">Cart</a></li>
                                        <li><a href="logout.php">Logout</a></li>

                                    <?php
                                    } else {
                                    ?>
                                        <li><a href="login.php">Login</a></li>
                                        <li><a href="signup.php">SignUp</a></li>

                                    <?php
                                    }
                                    ?>

                                </ul>
                            </nav>
                        </div>
                        <!-- Header Right -->
                        <div class="header-right">
                            <ul>
                                <li>
                                    <div class="nav-search search-switch">
                                        <span  class="flaticon-search"> </span>
                                    </div>
                                </li>
                                <?php
                                if (isset($_SESSION['Logged_in']) == true) {
                                ?>

                                    <li> <a href="index.php"><span class="flaticon-user"></span></a></li>
                                    <li><a href="cart.php"><span class="flaticon-shopping-cart"></span></a>


                                    <?php
                                }
                                    ?>
                                    </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Mobile Menu -->
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>