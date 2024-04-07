<?php
session_start();
require_once("../config/system.config.php");
if (isset($_SESSION['Logged_in']) && $_SESSION['user_type'] == 'seller') {
    require_once("../classes/user.class.php");
    $user = new User();
    $userInfo = $user->getLoggedInUserInformation($_SESSION['User_id']);
} else {
    echo "<script>
          window.location = '../logout.php';
            </script>";
}

?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?= SYS_TITLE_1HALF ?><?= SYS_TITLE_2HALF ?> </title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
        <!-- endinject -->
        <!-- icons -->
        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
        <!-- Plugin css for this page -->
        <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
        <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
        <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <!-- endinject -->
        <!-- Layout styles -->
        <link rel="stylesheet" href="assets/css/style.css">
        <!-- End layout styles -->
        <link rel="shortcut icon" href="<?= SYS_LOGO ?>" />
    </head>

    <body>

        <div class="container-scroller">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                    <a class="sidebar-brand brand-logo" href="index.php"><h4 class="text-light"><?= SYS_TITLE_1HALF ?><?= SYS_TITLE_2HALF ?></h4></a>
                    <a class="sidebar-brand brand-logo-mini" href="index.php"><p><?= SYS_TITLE_1HALF ?><?= SYS_TITLE_2HALF ?></p></a>
                </div>
                <ul class="nav">
                    <li class="nav-item profile">
                        <div class="profile-desc">
                            <div class="profile-pic">

                                <div class="profile-name">
                                    <h5 class="mb-0 font-weight-normal">
                                        <?= $userInfo[0]['fName'] ?> <?= $userInfo[0]['lName'] ?></h5>
                                    <span><?= $userInfo[0]['accountType'] ?></span>
                                </div>
                            </div>
                            <a href="#" id="profile-dropdown" data-toggle="dropdown"><i
                                    class="mdi mdi-dots-vertical"></i></a>
                            <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list"
                                aria-labelledby="profile-dropdown">
                                <a href="account_setting.php" class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-settings text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="account_setting.php" class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-onepassword  text-info"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>

                            </div>
                        </div>
                    </li>
                    <li class="nav-item nav-category">
                        <span class="nav-link">Navigation</span>
                    </li>
                    <li class="nav-item menu-items">
                        <a class="nav-link" href="index.php">
                            <span class="menu-icon">
                                <i class="mdi mdi-speedometer"></i>
                            </span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item nav-category">
                        <span class="nav-link">Products Management</span>
                    </li>

                    <li class="nav-item menu-items">
                        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false"
                            aria-controls="auth">
                            <span class="menu-icon">
                                <i class="mdi mdi-wallet-membership"></i>
                            </span>
                            <span class="menu-title">Products</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="auth">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="addproduct.php"> Add
                                        Products </a>
                                </li>
                                <li class="nav-item"> <a class="nav-link" href="product.php"> View Products </a></li>
                                
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item menu-items">
                        <a class="nav-link" data-toggle="collapse" href="#orders" aria-expanded="false"
                            aria-controls="orders">
                            <span class="menu-icon">
                                <i class="mdi mdi-wallet-membership"></i>
                            </span>
                            <span class="menu-title">Orders</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="orders">
                            <ul class="nav flex-column sub-menu">
                                <?php
                            $statusPending = "Pending";
                            $statusShipped = "shipped";
                            ?>
                                <li class="nav-item"> <a class="nav-link" href="order.php?status=<?= $statusPending ?>">
                                        New Orders
                                    </a>
                                </li>
                                <li class="nav-item"> <a class="nav-link" href="order.php?status=<?= $statusShipped ?>">
                                        Shipped
                                        Orders
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>



                    <li class="nav-item menu-items">
                        <a class="nav-link" data-toggle="collapse" href="#coupons" aria-expanded="false"
                            aria-controls="coupons">
                            <span class="menu-icon">
                                <i class="mdi mdi-security"></i>
                            </span>
                            <span class="menu-title">Discount Coupons</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="coupons">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="coupons.php"> Manage
                                        Coupons </a></li>

                            </ul>
                        </div>
                    </li>
                    <li class="nav-item menu-items">
                        <a class="nav-link" data-toggle="collapse" href="#users" aria-expanded="false"
                            aria-controls="users">
                            <span class="menu-icon">
                                <i class="mdi mdi-security"></i>
                            </span>
                            <span class="menu-title">All Users</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="users">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="viewusers.php"> View
                                        Users </a></li>

                            </ul>
                        </div>
                    </li>
                    <li class="nav-item menu-items">
                        <a class="nav-link" data-toggle="collapse" href="#pages" aria-expanded="false"
                            aria-controls="pages">
                            <span class="menu-icon">
                                <i class="mdi mdi-security"></i>
                            </span>
                            <span class="menu-title">All Pages</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="pages">
                            <ul class="nav flex-column sub-menu">
                                <ul class="nav flex-column sub-menu">
                                    <!-- <li class="nav-item"> <a class="nav-link" href="../index.php">
                                            Home </a></li> -->
                                    <li class="nav-item"> <a class="nav-link" href="../shop.php">
                                            Store </a></li>
                                    <!-- <li class="nav-item"> <a class="nav-link" href="../about.php">
                                            About </a></li>
                                    <li class="nav-item"> <a class="nav-link" href="../contact.php">
                                            Contact </a></li> -->

                                </ul>

                            </ul>
                        </div>
                    </li>

                </ul>
            </nav>

            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_navbar.html -->
                <nav class="navbar p-0 fixed-top d-flex flex-row">
                    <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                        <a class="navbar-brand brand-logo-mini" href="index.php"><img src="<? SYS_LOGO ?>"
                                alt="logo" /></a>
                    </div>
                    <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                        <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                            data-toggle="minimize">
                            <span class="mdi mdi-menu"></span>
                        </button>
                        <ul class="navbar-nav w-100">
                            <li class="nav-item w-100">
                                <?php
                            date_default_timezone_set('Asia/karachi');
                            $time = date('D H:i:s');
                            $date = date('d-M-Y');
                            ?>
                                <div class="">
                                    <p class="mb-0 d-none d-sm-block navbar-profile-name">Today is <?= $date ?>
                                        <?= $time ?>
                                    </p>
                                </div>

                            </li>
                        </ul>
                        <ul class="navbar-nav navbar-nav-right">


                            </li>
                            <li class="nav-item dropdown border-left">
                                <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown"
                                    href="<?= ADMIN_GMAIL_LINK ?>" target="_blank" aria-expanded="false">
                                    <i class="mdi mdi-email"></i>
                                    <span class="count bg-success"></span>
                                </a>

                            </li>

                            <li class="nav-item dropdown">
                                <a href="../logout.php" class="nav-link" id="profileDropdown">
                                    <div class="navbar-profile">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-logout text-danger"></i>
                                        </div>
                                        <p class="mb-0 d-none d-sm-block navbar-profile-name">
                                            Logout</p>

                                        <!-- <i class="mdi mdi-menu-down d-none d-sm-block"></i> -->

                                    </div>
                                </a>

                            </li>
                        </ul>
                        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                            data-toggle="offcanvas">
                            <span class="mdi mdi-format-line-spacing"></span>
                        </button>
                    </div>
                </nav>