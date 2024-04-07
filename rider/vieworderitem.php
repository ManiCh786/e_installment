<?php
require_once("includes/header.php");
if (isset($_SESSION['Logged_in']) && $_SESSION['user_type'] == 'rider') {
    require_once("../classes/order.class.php");
    $order_id = $_GET['order_id'];
    $vieword = new Checkout();
    $viewitems = $vieword->ViewOrderItems($order_id);
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
            <table class="table">
                <thead>
                    <tr>

                        <th scope="col">Product Image</th>
                        <th scope="col">Seller Name</th>
                        <th scope="col">Installment Plan</th>
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
                                <img style="height: 100px" src="../uploads/productsImages/<?= $items['pImage'] ?>" class="img-fluid rounded-3" alt="Image Not Found">
                            </td>
                           
                            <td>
                                <?= $items['shopName'] ?>
                            </td>
                         
                            <td>
                                <h5><?= $items['title'] ?></h5>
                            </td>
                            <td>
                                <h5><?= $items['pName'] ?></h5>
                            </td>
                            <td>
                                <h5><?= $items['pPrice'] ?></h5>
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