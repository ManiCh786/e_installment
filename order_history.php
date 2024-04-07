<?php
require_once("includes/header.php");
if (isset($_SESSION['Logged_in']) == true) {
    require_once("classes/order.class.php");
    $user_id = $_SESSION['User_id'];
    $history = new Checkout();
    $allhistory = $history->orderhistory($user_id);
} else {
    echo "<script>
    window.location = 'login.php';
    </script>";
}
?>
<div class="row mt-5">
    <div class="container">
        <?php
        if ($allhistory != false) {
        ?>
            <div class="table-responsive">
                <table class="table mb-5">
                    <thead>
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Price</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">View Items</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($allhistory as $hist) {
                        ?>
                            <tr>
                                <td><?= $hist['orderId'] ?></td>
                                <td><?= $hist['total'] ?></td>
                                <td><?= $hist['orderDate'] ?></td>
                                <td><?= $hist['status'] ?></td>
                                <td>
                                    <a class="btn btn-success" href="orderHistoryItem.php?order_id=<?= $hist['orderId'] ?>">View
                                        Item
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php
        } else {
        ?>
            <div class="row">
                <div class="col-3"></div>
                <div class="col-9 mb-5">
                    <h3>No Order History Found ! Continue Shopping ? </h3>
                </div>
                <div class="col-5"></div>
                <div class="col-lg-6  col-md-6 col-sm-6 mb-5">

                    <div class="input-group-append">
                        <div class=" input-group-text continue__btn">
                            <a href="shop.php" class="text-dark">Continue Shopping</a>
                        </div>


                    </div>

                </div>
            </div>
        <?php
        }
        ?>

    </div>
</div>

<?php
require_once("includes/footer.php");

?>