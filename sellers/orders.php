<?php
require_once("includes/header.php");
if (isset($_SESSION['Logged_in']) && $_SESSION['user_type'] == 'seller') {
    require_once("../classes/order.class.php");
    $ord = new Checkout();
    $status = "pending";
    $filter = $_POST['ordersFilter'];
    $sellerId = $_SESSION['User_id'];
    require_once("../classes/user.class.php");
    $user = new User();
   $check ="rider";
        // $check = 'newuser';
        $riders = $user->getAllUsers($check);
   
    
    $allorder = $ord->ViewAllOrders($filter,$sellerId);
    if (isset($_POST['ship'])) {

        $order_id = $_POST['orderId'];
        $sts = new Checkout($order_id);
        // $sts->UpdateStatus();
      
    }
    if (isset($_POST['assign'])) {

        $order_id = $_POST['orderId'];
        $riderId = $_POST['riderId'];
        $amountToRecieve = $_POST['amountToRecieve'];
        $status = "shipped";
        $sts = new Checkout($order_id);
        $sts->UpdateStatus($riderId,$amountToRecieve,$status);
      
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
                <option value="deliverd">Deliverd Orders</option>

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
                            <?php

                            if ($eachOrder['status'] != 'shipped'  ) {
                            ?>
                                <!-- Button to Open the Modal here-->
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#myModal<?= $eachOrder['orderId'] ?>">
                                    Assign
                                </button>
                                <!-- The Modal here-->
                                <div class="modal" id="myModal<?= $eachOrder['orderId'] ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Assign Order To Rider</h4>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <!-- <img src="uploads/category/" alt=""> -->
                                                <form action="" method="POST" enctype="multipart/form-data">
                                                   <h4>Select a Rider of you choice to deliver your Order !</h4>
                                                    
                                                    <h4 class="pt-2 mt-2">Riders</h4>

                                                    <select class="select" name="riderId">
                                                        <?php
                                                                foreach ($riders as $eachRider) {
                                                                ?>
                                                      
                                                        <option name="riderId" value="<?= $eachRider['userId'] ?>">
                                                            <?= $eachRider['fName'].$eachRider['lName'] ?></option>
                                                      <?php } ?>

                                                    </select>
                                                    <br>
                                                    <h4 class="pt-2 mt-2">Amount To Recieve</h4>
                                                        <textarea class=" form-control" name="orderDesc" type="text"
                                                            rows="1"><?= $eachOrder['total'] ?></textarea>
                                                    <br>
                                                    <input type="hidden" name="orderId" value="<?=$eachOrder['orderId'] ?>">
                                                    <input type="hidden" name="amountToRecieve" value="<?= $eachOrder['total'] ?>">                                         <br>
                                                    <input type="submit" name="assign" value="Assign"
                                                        class="btn btn-primary" id="">
                                                </form>
                                            
                                                                   <?php
                                                                
                                } else {
                                ?>
                                    <h5><?= $eachOrder['status'] ?></h5>
                                <?php
                                }
                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             

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