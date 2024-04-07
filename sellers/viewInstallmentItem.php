<?php
require_once("includes/header.php");
if (isset($_SESSION['Logged_in']) && $_SESSION['user_type'] == 'seller') {
    require_once("../classes/order.class.php");
    $order_id = $_GET['order_id'];
    $vieword = new Checkout();
    $viewitems = $vieword->ViewOrderItems($order_id);
    if (isset($_POST['add'])) {

        $order_id = $_POST['orderId'];
        $amount = $_POST['amount'];

        $sts = new Checkout($order_id);
        $sts->addInstallment($amount);
        echo "<script>
        window.location = 'addInstallment.php';
        </script>";
      
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
                    Order Items
                </h4>

            </div>
            <table class="table">
                <thead>
                    <tr>

                        <th scope="col">Product Image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Installment Plan</th>
                        <th scope="col">Item Price</th>
                        <th scope="col">DownPayment</th>
                        <th scope="col">Per Installment</th>
                        <th scope="col">Amount Recieved</th>
                        <th scope="col">Seller Name</th>

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
                                <h5><?= $items['pName'] ?></h5>
                            </td>
                            <td>
                                <h5><?= $items['title'] ?></h5>
                            </td>
                            <td>
                                <h5><?= $items['pPrice'] ?></h5>
                            </td>
                            <td>
                                <h5><?= $items['total'] ?></h5>
                            </td>
                            <td>
                                <h5><?= $items['itemPrice'] * ($items['installmentpermonth']/100) ?></h5>
                            </td> <td>
                                <h5><?= $items['amtRecieved'] ?></h5>
                            </td>
                            <td>
                            <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#myModal<?= $items['orderId'] ?>">
                                    Update
                                </button>
                                <!-- The Modal here-->
                                <div class="modal" id="myModal<?= $items['orderId'] ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Update Product</h4>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <!-- <img src="uploads/category/" alt=""> -->
                                                <form action="" method="POST" enctype="multipart/form-data">
                                                   <h4>Add Installment Recieved</h4>
                                                    
                                                    <h4 class="pt-2 mt-2">Amount(PKR)</h4>
                                                    <input type="number" name="amount" id="">
                                                   

                                                    <br>
                                                    
                                                    <input type="hidden" name="orderId" value="<?=$items['orderId'] ?>">
                                                    <br>
                                                    <input type="submit" name="add" value="Add"
                                                        class="btn btn-primary" id="">
                                                </form>
                                              
                                            </div>
                                        </div>
                                    </div>
                                </div>
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