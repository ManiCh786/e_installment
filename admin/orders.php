<?php
require_once("includes/header.php");
if (isset($_SESSION['Logged_in']) && $_SESSION['user_type'] == 'admin') {
    require_once("../classes/order.class.php");
    $ord = new Checkout();
    $status = "pending";
    $filter = $_POST['ordersFilter'];
    echo($filter);  
    $allorder = $ord->ViewAllOrders($filter);
    if (isset($_POST['ship'])) {

        $order_id = $_POST['orderId'];
        $sts = new Checkout($order_id);
        $sts->UpdateStatus();
        echo '<script type="text/javascript"> setTimeout(function () { swal({
                    title: "Success!",
                    text: "Order Status Changed Succesfully",
                    icon: "success",
                    button: "OK",
                  }); }, 1000 );</script>';
    }
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
                    Orders
                </h4>
                <!-- <h4 class="page-title ml-auto">
                        <a class="btn btn-success" href="addcategory.php">Add Category</a>
                        </h4> -->
            </div>
            <div class="col-8"></div>
            <div class="col-2">
            <h3>Filter By</h3>
       
                <form action="" method="POST">
                <select name="ordersFilter">
                <option value="shipped">Shipped Orders</option>
                <option value="pending">Pending Orders</option>
                </select>
                <input class="btn btn-info mt-3"type="submit" value="Search">

            </form>

            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Order ID</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Order Price</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Order Items</th>
                        <th scope="col">Status</th>

                    </tr>
                </thead>
                <?php
                foreach ($allorder as $eachOrder) {
                ?>
                    <tbody>
                        <tr>
                            <td>
                                <h5><?= $eachOrder['orderId'] ?></h5>
                            </td>
                            <td>
                                <?= $eachOrder['fName'] . $eachOrder['lName'] ?>
                            </td>
                            <td>

                                <h5><?= $eachOrder['total'] ?> PKR</h5>

                            </td>
                            <td>
                                <h5><?= $eachOrder['orderDate'] ?></h5>
                            </td>
                            <td>

                                <a class="btn btn-primary" href="vieworderitem.php?order_id=<?= $eachOrder['orderId'] ?>">View Items</a>
                            </td>
                            <td>
                              
                            
                                    <h5><?= $eachOrder['status'] ?></h5>
                              



                            </td>

                        </tr>

                    </tbody>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>




<?php
require_once("includes/footer.php");
?>