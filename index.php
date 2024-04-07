<?php

include_once("includes/header.php");
require_once("classes/products.class.php");
$newPro = new Products();
$newArivals = $newPro -> newArrivals();
if (isset($_SESSION['Logged_in'])) {
   
    // print_r($newProducts);
    if ($_SESSION['user_type'] == 'admin') {
        echo "<script>
        window.location = 'admin/index.php';
        </script>";
    }
}
?>
<main>
    <!--? slider Area Start -->
    <div class="slider-area ">
        <div class="slider-active">
            <!-- Single Slider -->
            <div class="single-slider slider-height d-flex align-items-center slide-bg">
                <div class="container">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                            <div class="hero__caption">
                                <h1 data-animation="fadeInLeft" data-delay=".4s" data-duration="2000ms">Buy Items of your choice</h1>
                                <p data-animation="fadeInLeft" data-delay=".7s" data-duration="2000ms"></p>
                                <!-- Hero-btn -->
                                <div class="hero__btn" data-animation="fadeInLeft" data-delay=".8s" data-duration="2000ms">
                                    <a href="shop.php" class="btn hero-btn">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class=" col-xl-2 col-lg-2 col-md-2 col-sm-2 d-none d-sm-block">
                            <div class="hero__img" data-animation="bounceIn" data-delay=".4s">
                                <img src="assets/img/hero/laptopnew.jpg" alt="" class=" heartbeat">
                            </div>
                        </div>
                        <div class="col-3"></div>
                    </div>
                </div>
            </div>
            <!-- Single Slider -->
            <!-- <div class="single-slider slider-height d-flex align-items-center slide-bg">
                <div class="container">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                            <div class="hero__caption">
                                <h1 data-animation="fadeInLeft" data-delay=".4s" data-duration="2000ms">Select Your
                                    New Perfect Style</h1>
                                <p data-animation="fadeInLeft" data-delay=".7s" data-duration="2000ms">Ut enim ad
                                    minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                    commodo consequat is aute irure.</p>
                                 Hero-btn -->
                                <!-- <div class="hero__btn" data-animation="fadeInLeft" data-delay=".8s" data-duration="2000ms">
                                    <a href="shop.php" class="btn hero-btn">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 d-none d-sm-block">
                            <div class="hero__img" data-animation="bounceIn" data-delay=".4s">
                                <img src="assets/img/hero/watch.png" alt="" class=" heartbeat">
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->




        </div>
    </div>
    <!-- slider Area End-->
    <!-- ? New Product Start -->
    <section class="new-product-area section-padding30">
        <div class="container">
            <!-- Section tittle -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="section-tittle mb-70">
                        <h2>New Arrivals</h2>
                    </div>
                </div>
            </div>
           
                        <div class="row">
                            <?php
                            foreach($newArivals as $newPro){
                            ?>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                <div class="single-new-pro mb-30 text-center">
                                    <div class="product-img">
                            <a href="shop.php">

                                        <img class="img img-fluid"   style="height:400px;width:400px;" src="uploads/productsImages/<?=$newPro['pImage']?>" alt="Image not Found">
                            </a>
                                    
                                    </div>
                                    <div class="product-caption">
                                        <h3><a href="product_details.php"><?=$newPro['pName']?></a></h3>
                                        <span>PKR <?=$newPro['pPrice']?></span>
                                    </div>
                                </div>
                            </div>
                                    <?php
                                }
                                ?>
                
             </div>
        </div>
    </section>
    <!--  New Product End -->
    <!--? Gallery Area Start -->
    <div class="gallery-area">
        <div class="container-fluid p-0 fix">
            <div class="row">
                <div class="col-xl-6 col-lg-4 col-md-6 col-sm-6">
                <a href="shop.php?filter=1">
     
                <div class="single-gallery mb-30">
                                                <div class="gallery-img big-img" style="background-image: url(assets/img/laptop/eidsale.jpg);"></div>
                    </div>
                    </a>

                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                <a href="shop.php?filter=1">
                    <div class="single-gallery mb-30">
                        <div class="gallery-img big-img" style="background-image: url(assets/img/laptop/fridge.jpg);"></div>
                    </div>
                    </a>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-12">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6">
                            <a href="shop.php?filter=2">
                            <div class="single-gallery mb-30">
                                <div class="gallery-img small-img" style="background-image: url(assets/img/phones/sam-a32.jpg);"></div>
                            </div>
                            </a>
                        </div>
                        <div class="col-xl-12 col-lg-12  col-md-6 col-sm-6">
                        <a href="shop.php?filter=1">
                            <div class="single-gallery mb-30">
                                <div class="gallery-img small-img" style="background-image: url(assets/img/laptop/ac.jpg);"></div>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Gallery Area End -->
 
    <!-- Popular Items End -->
    <!--? Video Area Start -->
    <!-- Video Area End -->
    <!--? Watch Choice  Start-->
    <div class="watch-area section-padding30">
        <div class="container">
            <div class="row align-items-center justify-content-between padding-130">
                <div class="col-lg-5 col-md-6">
                    <div class="watch-details mb-40">
                        <h2>Products of Your Choice</h2>
                        <p>Enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                            commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>
                        <a href="shop.php" class="btn">Show Products</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-10">
                    <div class="choice-watch-img mb-40">
                        <img src="assets/img/images/laptopnew.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-6 col-md-6 col-sm-10">
                    <div class="choice-watch-img mb-40">
                        <img src="assets/img/images/electronics.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="watch-details mb-40">
                        <h2>Any Existing Thing is Here</h2>
                        <p>Enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                            commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>
                        <a href="shop.php" class="btn">Show Products</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Watch Choice  End-->
    <!--? Shop Method Start-->
    <div class="shop-method-area">
        <div class="container">
            <div class="method-wrapper">
                <div class="row d-flex justify-content-between">
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single-method mb-40">
                            <i class="ti-package"></i>
                            <h6>Free Shipping Method</h6>
                            <p>aorem ixpsacdolor sit ameasecur adipisicing elitsf edasd.</p>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single-method mb-40">
                            <i class="ti-unlock"></i>
                            <h6>Secure Payment System</h6>
                            <p>aorem ixpsacdolor sit ameasecur adipisicing elitsf edasd.</p>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single-method mb-40">
                            <i class="ti-reload"></i>
                            <h6>Secure Payment System</h6>
                            <p>aorem ixpsacdolor sit ameasecur adipisicing elitsf edasd.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Method End-->
</main>
<?php

include_once("includes/footer.php");
?>