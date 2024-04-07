<?php
require_once("includes/header.php");
if (isset(_SESSION['Logged_in']) && $_SESSION['user_type'] == 'seller') {
    require_once("../classes/order.class.php");
    $ord = new Checkout();
    $orderStatus = $_GET['status'];
    $allorder = $ord->ViewAllOrders($orderStatus);
    if (isset($_POST['delete'])) {
        $orderId = $_POST['orderId'];
        $delOrder = new Checkout($orderId);
        $delete = $delOrder->deleteOrder();
        echo "<script>
window.location = 'order.php?status=$orderStatus';
</script>";
    }


    if (isset($_POST['viewCDetails'])) {
        $orderId = $_POST['orderId'];

        echo "<script>
        window.location = 'orderdetails.php?orderId=$orderId';
        </script>";
    }
    if (isset($_POST['ship'])) {

        $order_id = $_POST['orderId'];
        $sts = new Checkout($order_id);
        $sts->UpdateStatus();
        echo "<script>
window.location = 'order.php?status=$orderStatus';
</script>";
    }
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
    overflow-y: scroll;
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
                            <th scope="col">Subtotal</th>
                            <th scope="col">Coupon Code</th>
                            <th scope="col">Coupon %</th>
                            <th scope="col">Total Bill</th>
                            <th scope="col ">Order Date</th>
                            <th scope="col">C. Details</th>
                            <th scope="col">Orderd Items</th>
                            <th scope="col">Status</th>
                            <th scope="col ">Delete</th>

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

                                <h5><?= $eachOrder['subtotal'] ?> PKR</h5>

                            </td>
                            <td>
                                <h5><?= $eachOrder['couponCode'] ?></h5>
                            </td>
                            <td>
                                <h5><?= $eachOrder['couponPercent'] ?></h5>
                            </td>
                            <td>
                                <h5><?= $eachOrder['total'] ?></h5>
                            </td>
                            <td>
                                <h5><?= $eachOrder['orderDate'] ?></h5>
                            </td>
                            <td>
                                <form action="" method="POST">
                                    <input type="hidden" name="orderId" value="<?= $eachOrder['orderId'] ?>">
                                    <input type="submit" name="viewCDetails" class="btn btn-success"
                                        value="View C. Details" id="">
                                </form>
                            </td>




                            <td>

                                <a class="btn btn-primary"
                                    href="vieworderitem.php?order_id=<?= $eachOrder['orderId'] ?>">View
                                    Item</a>
                            </td>
                            <td>
                                <?php

                                        if ($eachOrder['status'] != 'shipped') {
                                        ?>

                                <form action="" method="POST">
                                    <input type="hidden" name="orderId" value="<?= $eachOrder['orderId'] ?>">
                                    <input type="submit" class="btn btn-primary" name="ship" value="SHIP NOW">
                                </form>
                                <?php
                                        } else {
                                        ?>
                                <h5><?= $eachOrder['status'] ?></h5>
                                <?php
                                        }
                                        ?>



                            </td>

                            <td>
                                <form action="" method="POST">
                                    <input type="hidden" name="orderId" value="<?= $eachOrder['orderId'] ?>">
                                    <input type="submit" name="delete" class="btn btn-danger" value="Delete" id="">
                                </form>
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