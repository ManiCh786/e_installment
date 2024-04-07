<?php

include_once("includes/header.php");
require_once("classes/products.class.php");
$products = new Products();
if (isset($_GET['filter'])) {
    if($_GET['filter'] == "new"){
        $allProducts = $products->displayProductsByCategory(0, 'new', "");
    }else if($_GET['filter']=="priceDSC"){
        $allProducts = $products->displayProductsByCategory(0,$_GET['filter'],"");
    }
    else if($_GET['filter']=="priceASC"){
        $allProducts = $products->displayProductsByCategory(0,$_GET['filter'],"");
    }
    else{
        $catId = $_GET['filter'];
        $allProducts = $products->displayProductsByCategory($catId, '', "");
    }
    
}else if(isset($_GET['searchQry'])){
    $searchQry = $_GET['searchQry'];
        $allProducts = $products->displayProductsByCategory(0, 'search', $searchQry);
    
}else{
$allProducts = $products->displayProductsByCategory(0,"","");

}
// print_r($allProducts);

// if (isset($_GET['filter'])) {
 
// } 
// priceDSC
// print_r($priceHightToLow);
// print_r($allProducts);
?>

<main>
    <!-- Hero Area Start-->
    <div class="slider-area ">
        <div class="single-slider slider-height2 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Our Products</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Area End-->
    <!-- Latest Products Start -->
    <section class="popular-items latest-padding">
        <div class="container">
            <div class="row product-btn justify-content-between mb-40">
                <div class="properties__button">
                    <!--Nav Button  -->
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <?php
                            $filter = 'priceDSC';
                            $filterAsc='priceASC';
                            ?>    
                        <a class="nav-item nav-link 
                        <?php  
                            if(!isset($_GET['filter'])){
                                ?>

                                active
                                <?php
                            
                            }
                            ?>
                            " id="nav-home-tab"  href="shop.php"  >Newest Arrivals</a>
                            <form action="" method = "POST">
                            <!-- <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="shop.php??" role="tab" aria-controls="nav-profile" > Price high to low</a> -->
                            <!-- <input type="hidden" name="priceFilter" value="priceDSC">   -->
                            <!-- <a href=""></a> -->
                            <a  class="nav-item nav-link <?php  
                            if(isset($_GET['filter'])){
                                if($_GET['filter']=="priceDSC"){
                                ?>

                                active
                                <?php
                            }
                            }
                             ?>" id="nav-profile-tab"   href="shop.php?filter=<?=$filter?>">Price High to Low</a>
                             
                            <!-- <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="shop.php??" role="tab" aria-controls="nav-profile" > Price high to low</a> -->
                            <!-- <input type="hidden" name="priceFilter" value="priceDSC">   -->
                            <!-- <a href=""></a> -->
                           </form>
                           <form action="" method="POST">
                           <a  class="nav-item nav-link <?php  
                            if(isset($_GET['filter'])){
                                if($_GET['filter']=="priceASC"){
                                ?>

                                active
                                <?php
                            }
                            }
                            ?>" id="nav-profile-tab"   href="shop.php?filter=<?=$filterAsc?>">Price Low to High</a>
                         
                           </form>
                            <!-- <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact"
                                role="tab" aria-controls="nav-contact" aria-selected="false"> Most populer </a> -->
                        </div>
                    </nav>
                    <!--End Nav Button  -->
                </div>
                <!-- Grid and List view -->
                <div class="grid-list-view">
                </div>
                <!-- Select items -->
                <!-- <div class="select-this">
                    <form action="#">
                        <div class="select-itms">
                            <select name="select" id="select1">
                                <option value="">40 per page</option>
                                <option value="">50 per page</option>
                                <option value="">60 per page</option>
                                <option value="">70 per page</option>
                            </select>
                        </div>
                    </form>
                </div> -->
            </div>
            <!-- Nav Card -->
            <div class="tab-content" id="nav-tabContent">
                <!-- card one -->
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row">
                        <?php
                        if ($allProducts == false) {

                        ?>
                            <h1>Nothing Found !</h1>
                            <?php
                        } else {
                            foreach ($allProducts as $each) {
                            ?>
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                    <div class="single-popular-items mb-50 text-center">
                                        <div class="popular-img">
                                            <!-- style="height:400px;width:400px;" -->
                                            <img class="img img-fluid" style="height:400px;width:400px;" src="uploads/productsImages/<?= $each['pImage'] ?>" alt="">
                                            <div class="img-cap">
                                                <span> <a href="product_details.php?pName=<?= $each['pName'] ?> & id=<?= $each['pId'] ?>"> Add to cart</a></span>
                                            </div>
                                            <div class="favorit-items">
                                                <span class="flaticon-heart"></span>
                                            </div>
                                        </div>
                                        <div class="popular-caption">
                                            <h3><a href='product_details.php?pName=<?= $each['pName'] ?> & id=<?= $each['pId'] ?>'><?= $each['pName'] ?></a></h3>
                                            <span>PKR <?= $each['pPrice'] ?></span>
                                            <h5><?=$each['shopName']?></h5>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>

                    </div>
                </div>
                <!-- Card two -->
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="row">
                        <?php
                        foreach ($priceHightToLow as $each) {
                        ?>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                <div class="single-popular-items mb-50 text-center">
                                    <div class="popular-img">
                                        <img class="img img-fluid" style="height:400px;width:400px;" src="uploads/productsImages/<?= $each['pImage'] ?>" alt="">
                                        <div class="img-cap">
                                            <span> <a href="product-details.php?pName=<?= $each['pName'] ?> & id=<?= $each['pId'] ?>"> Add to cart </a></span>
                                        </div>
                                        <div class="favorit-items">
                                            <span class="flaticon-heart"></span>
                                        </div>
                                    </div>
                                    <div class="popular-caption">
                                        <h3><a href="product_details.php?pName=<?= $each['pName'] ?> & id=<?= $each['pId'] ?>"><?= $each['pName'] ?></a></h3>
                                        <span>PKR - <?= $each['pPrice'] ?></span>
                                        <h5><?=$each['shopName']?></h5>

                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                </div>
                <!-- Card three -->

            </div>
            <!-- End Nav Card -->
        </div>
    </section>
    <!-- Latest Products End -->
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
</div
<?php
include_once("includes/footer.php");
?>