<?php
require_once("includes/header.php");
if (isset(_SESSION['Logged_in']) && $_SESSION['user_type'] == 'seller') {
    require_once("../classes/order.class.php");
    $ord = new Checkout();
    $orderId = $_GET['orderId'];
    $allorder =  $ord->checkOrderbyOrderId($orderId);
} else {
    echo "<script>
window.location = '../logout.php';
</script>";
}

?>
<style>
.content_td h5 {
    /* max-width: 100%; */
    max-height: 300px;
    overflow-x: scroll;
    /* text-overflow: ellipsis; */
}
</style>
<div class="main-panel">
    <?php
    if ($allorder != false) {

    ?>
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">
                    Orders
                </h4>
                <h4 class="page-title ml-auto">
                    <a class="btn btn-success" href="addproduct.php">Add Product</a>
                </h4>
            </div>
            <div class="table-responsive ">
                <table class="table table-striped w-auto table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Customer Email</th>
                            <th scope="col">Customer Phone</th>
                            <th scope="col">Order Notes</th>
                            <th scope="col">Address</th>
                            <th scope="col">Optional Address</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($allorder as $eachOrder) {
                            ?>
                        <tr>
                            <td>
                                <h5><?= $eachOrder['orderId'] ?></h5>
                            </td>
                            <td>
                                <?= $eachOrder['cEmail'] ?>
                            </td>
                            <td>

                                <h5><?= $eachOrder['cPhone'] ?> </h5>

                            </td>
                            <td style=" max-width:500px;max-height:300px;" class="content_td">
                                <h5><?= $eachOrder['cOrderNotes'] ?></h5>
                            </td>



                            <td>
                                <h5><?= $eachOrder['cAddress'] ?></h5>
                            </td>
                            <td>
                                <h5><?= $eachOrder['cOptionalAddress'] ?></h5>
                            </td>


                        </tr>
                        <?php

                            }
                            ?>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <?php
    } else {
    ?>
    <div class="row mt-5">
        <div class="col-3"></div>
        <div class="col-9 mb-5">
            <h3>Nothing to show here !</h3>
        </div>
        <div class="col-5 mt-5"></div>
        <div class="col-lg-6 col-md-6 col-sm-6">
        </div>

    </div>
    <?php
    }
    ?>


    <?php
    require_once("includes/footer.php");
    ?>