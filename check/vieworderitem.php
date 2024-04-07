<?php
require_once("includes/header.php");
if (isset($_SESSION['Logged_in']) && $_SESSION['user_type'] == 'seller') {
    require_once("../classes/order.class.php");
    $order_id = $_GET['order_id'];
    $vieword = new Checkout($order_id);
    $viewitems = $vieword->ViewOrderItems($order_id);
    // print_r($viewitems);

    // echo '<script>alert(' . $order_id . ')</script>';
} else {
    echo "<script>
            window.location = '../login.php';
            </script>";
}
?>




<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">
                    Order Items
                </h4>

            </div>
            <div class="table-responsive-lg">

                <table class="table">
                    <thead>
                        <tr>

                            <th scope="col">Product Image</th>
                            <th scope="col">Order ID</th>
                            <th scope="col">Item ID</th>
                            <th scope="col">Product ID</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Item Price</th>
                            <th scope="col">Item Quantity</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($viewitems as $items) {
                        ?>
                        <tr>
                            <td>
                                <img style="height: 150px; width:200px" src="../upload/images/<?= $items['pImage'] ?>"
                                    class="img-fluid rounded-3" alt="Image Not Found">
                            </td>
                            <td>
                                <h5><?= $items['orderId'] ?></h5>
                            </td>
                            <td>
                                <?= $items['itemId'] ?>
                            </td>
                            <td>
                                <h5><?= $items['proId'] ?></h5>
                            </td>
                            <td>
                                <h5><?= $items['pName'] ?></h5>
                            </td>
                            <td>
                                <h5><?= $items['pDiscountPrice'] ?></h5>
                            </td>
                            <td>
                                <h5><?= $items['quantity'] ?></h5>
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
    require_once("includes/footer.php");
    ?>