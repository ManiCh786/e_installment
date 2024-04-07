<?php

include_once("includes/header.php");

require_once("classes/products.class.php");
require_once("classes/installmentplans.class.php");
require_once('classes/feedback.class.php');
require_once('classes/cart.class.php');


$pName = $_GET['pName'] ?? 'NEw Laptop';
$pId = $_GET['id'] ?? '12';

$products = new Products();
$allProducts = $products->singleProduct($pName, $pId);

$plan = new InstallmentPlans();
$allPlans = $plan->getInstallmentPlans();
if (isset($_POST['submitcomment'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['msg'];

    $feed = new Feedback(0, $name, $email, $message, $pId);
    $feed->comment();
}
if (isset($_POST['delComment'])) {
    if (isset($_SESSION['loged_in']) && $_SESSION['user_type'] == 'Admin') {
        $commentId = $_POST['commentId'];
        $feed = new Feedback($commentId);
        $delComment = $feed->deleteComment();
    } else {
        echo "<script type='text/javascript'>alert('You can't Delete the comment ! ')</script>";
    }
}

$showcomments = new Feedback();
$allfeedback = $showcomments->FetchAllComments($pId);

if (isset($_POST['addtocart'])) {
    if (isset($_SESSION['Logged_in']) == true) {
        $proName = $_POST['proName'];
        $pDesc = $_POST['proDesc'];
        $pImage = $_POST['proImage'];
        $pPrice = $_POST['proPrice'];
        // $userId = $_SESSION['User_id'];
        $proId = $_POST['proId'];
        $qty = $_POST['qty'];
        $sellerId = $_POST['sellerId'];
        $installmentId = $_POST['installmentRadio'];
        $userId = $_SESSION['User_id'];

        if ($qty != 0) {
            $cart = new Cart(0, $proName, $pDesc, $pImage, $pPrice, $userId, $proId, $sellerId, $qty, $installmentId);
            $addtocart = $cart->addToCart();
            // header("Refresh:1");
        } else {
            echo "<script type='text/javascript'>alert('Quantity should be greater than 0')</script>";
        }
    } else {
        echo "<script>
            window.location = 'login.php';
            </script>";
    }
}


?>
<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0 "><a href="index.php " class="text-dark">Home</a> <span class="mx-2 mb-0">/</span> <a href="shop.php" class="text-dark">Store</a> <span class="mx-2 mb-0">/</span> <strong class="text-black"><?= $pName ?></strong></div>
        </div>
    </div>
</div>

<div class="site-section mt-5">
    <?php
    foreach ($allProducts as $eachProduct) {
    ?>
        <div class="container">
            <div class="row">
                <div class="col-md-5 mr-auto">
                    <div class="border text-center">
                        <img src="uploads/productsImages/<?= $eachProduct['pImage'] ?>" alt="Image" class="img-fluid p-5">
                    </div>
                </div>
                <div class="col-md-6">
                    <h2 class="text-black"><?= $eachProduct['pName'] ?></h2>
                    <li><a class="active text-dark" href="#"><span>Category</span> : <?= $eachProduct['cat_Name'] ?> </a></li>
                    <li><a href="#" class="text-dark mb-2"><span>Availibility</span> :
                            <?= $eachProduct['inStock'] == "Yes" || "yes" ? 'In Stock' : 'Out of Stock' ?></a></li>
                    <p class="mt-3"> <strong class="text-primary mt-3 h4 mt-3 mb-2 text-danger">RS: <?= $eachProduct['pPrice'] ?> PKR</strong></p>

                    <form action="" method="POST">
                        <div class="mb-5">

                            <div class="input-group mb-3" style="max-width: 120px;">
                                <div class="input-group-prepend mr-2">
                                    <button style="max-height: 20px;" class="btn  js-btn-minus" type="button">&minus;</button>

                                    <input class="product_count_item text-center input-number ml-2" type="number" name="qty" value="1" min="1" max="1">
                                    <div class="input-group-append ml-2">
                                        <!-- <input type="submit" class="btn btn-outline-primary js-btn-plus" type="button" value="&plus;"> -->
                                        <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                                    </div>
                                </div>


                                <!-- <p>PKR - <?= $eachProduct['pPrice'] ?> </p> -->
                            </div>
                            <Label class="">Select an Installment Plan</Label>
                            <?php
                            foreach ($allPlans as $eachPlan) {
                            ?>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="radio1" name="installmentRadio" value="<?= $eachPlan['installmentId'] ?>" checked><?= $eachPlan['title'] ?>
                                    <label class="form-check-label" for="radio1">(DownPayment: ( <?= $eachProduct['pPrice'] * ($eachPlan['downpayment'] / 100) ?> ) Installment/Month: <?= $eachProduct['pPrice'] * ($eachPlan['installmentpermonth'] / 100) ?>)</label>
                                </div>
                            <?php
                            }
                            ?>
                            <input type="hidden" name="proId" value="<?= $eachProduct['pId'] ?>">
                            <input type="hidden" name="proImage" value="<?= $eachProduct['pImage'] ?>">
                            <input type="hidden" name="proName" value="<?= $eachProduct['pName'] ?>">
                            <input type="hidden" name="proDesc" value="<?= $eachProduct['pDesc'] ?>">
                            <input type="hidden" name="proPrice" value="<?= $eachProduct['pPrice'] ?>">
                            <input type="hidden" name="sellerId" value="<?= $eachProduct['sellerId'] ?>">
                            <!-- <input type="hidden" name="installmentId" value="<?= $eachPlan['installmentId'] ?>"> -->
                            <?php
                            if ($eachProduct['inStock'] == "yes" || "Yes") { ?>
                                <input type="submit" class="mt-4 buy-now btn btn-sm height-auto px-4 py-3 btn-primary" name="addtocart" value="Add to Cart">
                            <?php
                            } else {
                            ?>
                                <p>Sorry,The Product is out of stock. You can order when it will be back in Stock. Thank You ! </p>

                            <?php
                            }
                            ?>
                    </form>


                </div>
            </div>
        </div>
        <section class="product_description_area">
            <div class="container">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Comments</a>
                    </li>

                </ul>
                <section>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade mt-3 ml-3" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <p><?= $eachProduct['pDesc'] ?></p>
                        </div>
                        <div class="tab-pane fade show active" id="contact" role="tabpanel" aria-labelledby="contact-tab">

                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-5 col-md-6 col-12 pb-4">
                                        <h1 class="text-dark">Comments</h1>
                                        <!-- <div class="col5">

                                    </div> -->
                                        <?php
                                        if ($allfeedback != false) {
                                            foreach ($allfeedback as $feedback) {
                                        ?>
                                                <div class="comment mt-4 text-justify bgdark">

                                                    <img src="https://i.imgur.com/yTFUilP.jpg" alt="" class="rounded-circle" width="40" height="40">
                                                    <h4><?= $feedback['feed_name'] ?></h4>
                                                    <!-- <span>- <?= $feedback['addedOn'] ?></span> -->
                                                    <span class="ml-4"> <?= $feedback['feed_email'] ?></span>
                                                    <br>
                                                    <p class="mt-2 ml-2"><?= $feedback['feed_content'] ?></p>
                                                    <div class="input-group">
                                                        <!-- <span>
                                                <form action="" method="POST">
                                                    <input type="submit" class="btn btn-link" value="reply">
                                                </form>
                                            </span>-->
                                                        <?php
                                                        if (isset($_SESSION["user_type"])) {
                                                            if ($_SESSION["user_type"] == "admin") {
                                                        ?>
                                                                <span>
                                                                    <form action="" method="POST">
                                                                        <input type="hidden" name="commentId" value="<?= $feedback['feed_id'] ?>">
                                                                        <input type="submit" class="btn btn-link text-danger" name="delComment" value="Delete">
                                                                    </form>
                                                                </span>
                                                            <?php
                                                            } else {

                                                            ?>
                                                                <span class="float-right  mt-2">Added On: </span>

                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                        <span class="float-right  mt-2">-
                                                            <?= $feedback['addedOn'] ?></span>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                    </div>
                                    <p class="text-center mt-3">No Comments Posted Yet !</p>
                                <?php
                                        }
                                ?>
                                </div>
                                <div class="col-lg-4 col-md-5 col-sm-4 offset-md-1 offset-sm-1 col-12 mt-4">

                                    <form id="algin-form" class="formClass" method="POST">
                                        <div class="form-group">
                                            <h4>Leave a comment</h4>
                                            <label for="message">Message</label>
                                            <textarea name="msg" id="" placeholder="Message" required msg cols="30" rows="5" class="form-control" style="background-color: white;"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" placeholder="Your Full name" required id="fullname" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" name="email" placeholder="Email Address" required id="email" class="form-control">
                                        </div>


                                        <div class="form-group">
                                            <input type="submit" id="post" class="btn" value="Post Comment" name="submitcomment">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </section>
    <?php
    }
    ?>
</div>


<?php
if (isset($_SESSION['Logged_in']) == true) {

?>
<?php
} else {
?>
    <div class="site-section bg-image overlay" style="background-image: url('images/hero_bg_2.jpg');">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-7">
                    <h3 class="text-white">Sign up for discount up to 10% OFF</h3>
                    <p class="text-white">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nemo omnis
                        voluptatem
                        consectetur quam.</p>
                    <p class="mb-0"><a href="signup.php" class="btn btn-outline-white">Sign up</a></p>
                </div>
            </div>
        </div>
    </div>

<?php
}
?>


<?php

include_once("includes/footer.php");
?>