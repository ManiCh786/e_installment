<?php
require_once("includes/header.php");
if (isset($_SESSION['Logged_in']) && $_SESSION['user_type'] == 'rider') {
    require_once("../classes/order.class.php");
    $ord = new Checkout();
    $status = "pending";
    $filter = $_POST['ordersFilter'];
    $riderId = $_SESSION['User_id'];
    require_once("../classes/user.class.php");
    $user = new User();
   $check ="rider";
        // $check = 'newuser';
        $riders = $user->getAllUsers($check);
   
    
    $allorder = $ord->getRidersOrder($riderId);
  
    if (isset($_POST['setToDeliverd'])) {

        $order_id = $_POST['orderId'];
        $amountRecieved = $_POST['amountRecieved'];
        $status = "deliverd";
        $sts = new Checkout($order_id);
        $sts->setToDeliverd($amountRecieved,$status);
      
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
         

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Order ID</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Amount TO Recieve</th>
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

                                <h5><?= $eachOrder['amountToRecieve'] ?> PKR</h5>

                            </td>
                            <td>
                                <h5><?= $eachOrder['orderDate'] ?></h5>
                            </td>
                            <td>

                                <a class="btn btn-primary" href="vieworderitem.php?order_id=<?= $eachOrder['orderId'] ?>">View Items</a>
                            </td>
                            <td>
                            <?php
                            

                            if ($eachOrder['status'] != 'deliverd') {
                            ?>
                                <!-- Button to Open the Modal here-->
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#myModal<?= $eachOrder['orderId'] ?>">
                                    Set to Deliverd
                                </button>
                                <!-- The Modal here-->
                                <div class="modal" id="myModal<?= $eachOrder['orderId'] ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title"></h4>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <!-- <img src="uploads/category/" alt=""> -->
                                                <form action="" method="POST" enctype="multipart/form-data">
                                                   <h4>Enter the amount you recieved from the customer !</h4>
                      
                         
                                                    <br>
                                                    <h4 class="pt-2 mt-2">Amount Recieved</h4>
                                                    <input type="number" name="amountRecieved" id="">
                                                        <br>
                                                    <input type="hidden" name="orderId" value="<?=$eachOrder['orderId'] ?>">
                                                    <!-- <input type="hidden" name="riderId" value="<?= $eachRider['userId'] ?>"> -->
                                                    <!-- <input type="hidden" name="amountToRecieve" value="<?= $eachOrder['total'] ?>"> -->
                                                       <br>
                                                    <input type="submit" name="setToDeliverd" value="Set To Deliverd"
                                                        class="btn btn-primary" id="">
                                                </form>
                                              
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
} else {
?>
    <h5><?= $eachOrder['status'] ?></h5>
<?php
}
?>

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