<?php

include_once("includes/header.php");

require_once("classes/products.class.php");
require_once("classes/installmentplans.class.php");

    $pName = $_GET['pName']??'';
    $pId = $_GET['id']??'';

    $products = new Products();
    $allProducts = $products->singleProduct($pName,$pId);

    $plan = new InstallmentPlans();
    $allPlans = $plan -> getInstallmentPlans();
    if(isset($_POST['addtocart'])){
        if(isset($_SESSION['Logged_in'])){
            $proName = $_POST['proName'];
            $pDesc = $_POST['proDesc'];
            $pImage = $_POST['proImage'];
            $pPrice = $_POST['proPrice'];
            // $userId = $_SESSION['User_id'];
            $proId = $_POST['proId'];
            $qty = $_POST['qty'];
            $sellerId = $_POST['sellerId'];
            $installmentId = $_POST['installmentId'];

            
            // echo($proName);
            // echo($installmentId);
            // echo($pDesc);
            // echo($pImage);
            // echo($pPrice);
            // echo($userId);
            // echo($qty);
            // echo($sellerId);
        }else{
            echo "<script>
            window.location = 'login.php';
            </script>";
        }
    }
   

?>

<main>
    <!-- Hero Area Start-->
    <!-- <div class="slider-area ">
        <div class="single-slider slider-height2 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Watch Shop</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Hero Area End-->
    <!--================Single Product Area =================-->
    <div class="product_image_area">
        <div class="container">
            <?php
            foreach($allProducts as $each){
            ?>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="product_img_slide owl-carousel">
                        <div class="single_product_img">
                            <img src="uploads/productsImages/<?=$each['pImage']?>" alt="#" class="img-fluid">
                        </div>
                        
                        <!-- <div class="single_product_img">
                            <img src="assets/img/gallery/gallery01.png" alt="#" class="img-fluid">
                        </div>
                        <div class="single_product_img">
                            <img src="assets/img/gallery/gallery1.png" alt="#" class="img-fluid">
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="single_product_text text-center">
                        <h3><?=$each['pName']?></h3>
                        <p>
                        <?=$each['pDesc']?>
                        </p>
                        
                        <div class="card_area">
                            
                            <div class="product_count_area">
                                <p>Quantity</p>
                                <form action="" method="POST">
                                <div class="product_count d-inline-block">
                                    <span class="product_count_item inumber-decrement"> <i class="ti-minus"></i></span>
                                    <input class="product_count_item input-number" type="text" name="qty" value="1" min="0"
                                        max="10">
                                    <span class="product_count_item number-increment"> <i class="ti-plus"></i></span>
                                </div>
                                <p>PKR - <?=$each['pPrice']?></p>
                            </div>
                            <div class="col-lg-12  mt-3 ">
                                <Label class="">Select an Installment Plan</Label>
                                <?php
                                foreach($allPlans as $eachPlan){
                                ?>
                                <div class="form-check">
                                <input type="radio" class="form-check-input" id="radio1" name="installmentRadio" value="<?=$eachPlan['installmentId']?>" checked><?=$eachPlan['title']?>
                                <label class="form-check-label" for="radio1">(DownPayment: <?=$eachPlan['downpayment']?> Installment/Month: <?=$eachPlan['installmentpermonth']?>)</label>
                                </div>
                                <?php
                                }
                                ?>
                               
                            <div class="add_to_cart">
                                    <input type="hidden" name="proName" value="<?=$each['pName']?>">
                                    <input type="hidden" name="proDesc" value="<?=$each['pDesc']?>">
                                    <input type="hidden" name="proImage" value="<?=$each['pImage']?>">
                                    <input type="hidden" name="proPrice" value="<?=$each['pPrice']?>">
                                    <input type="hidden" name="proId" value="<?=$each['pId']?>">
                                    <input type="hidden" name="sellerId" value="<?=$each['sellerId']?>">
                                    <input type="hidden" name="installmentId" value="<?=$eachPlan['installmentId']?>">

                                    <input type="submit"  class="btn_3" name = "addtocart" value="Add to cart">
                                </form>
                                <!-- <a href="#" class="btn_3"></a> -->
                            </div>
                           
                        </div>
                    </div>
                </div>
                
            </div>
            <?php
            }
            ?>
        </div>
    </div>
    <!--================End Single Product Area =================-->
    <!-- subscribe part here -->
    <section class="subscribe_part section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="subscribe_part_content">
                        <h2>Get promotions & updates!</h2>
                        <p>Seamlessly empower fully researched growth strategies and interoperable internal or “organic”
                            sources credibly innovate granular internal .</p>
                        <div class="subscribe_form">
                            <input type="email" placeholder="Enter your mail">
                            <a href="#" class="btn_1">Subscribe</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- subscribe part end -->
</main>
<?php

    include_once("includes/footer.php");
    ?>