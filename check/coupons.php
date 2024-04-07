<?php
require_once("includes/header.php");
if (isset($_SESSION['Logged_in']) && $_SESSION['user_type'] == 'seller') {
    require_once("../classes/coupons.class.php");
    $cop = new Coupons();
    $allCoupons = $cop->viewAllCoupons();

    if (isset($_POST['addCop'])) {
        $copCode = $_POST['copCode'];
        $copDiscount = $_POST['discount'];
        if ($copCode != '' && $copDiscount != '') {
            $addCop = new Coupons(0, $copCode, $copDiscount);
            $add = $addCop->addCoupon();
            echo "<script>
          window.location = 'coupons.php';
           </script>";
        } else {
            echo ('<script>alert("Coupon Name or Amount Is Empty")</script>');
        }
    }
    if (isset($_POST['update'])) {
        $id = $_POST['copId'];
        $couponCode = $_POST['copName'];
        $discount = $_POST['copDiscount'];

        if ($couponCode != '' &&  $discount != '') {
            $update = new Coupons($id, $couponCode, $discount);
            $update->updateCoupons();
            echo "<script>
         window.location = 'coupons.php';
         </script>";
        } else {
            echo "<script type='text/javascript'>alert('Enter Values in the required fields')</script>";
        }
    }
    if (isset($_POST['delete'])) {
        $id = $_POST['copId'];
        $delCop = new Coupons($id);
        $delete = $delCop->deleteCoupon();
        echo "<script>
    window.location = 'coupons.php';
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
                    Coupons
                </h4>
            </div>
            <div class="col-12 col-md-8 input-group mb-3">
                <form action="" method="POST">
                    <div class="input-group mb-3">
                        <input type="text" name="copCode" placeholder="Enter Coupon Code" class="form-control"
                            required />
                        <input type="tel" name="discount" placeholder="Enter Coupon Discount" class=" ml-3 form-control"
                            pattern="[0-9]{1,2}" required />
                        <div class="input-group-append">
                            <input type="submit" name="addCop" value="Add Coupon" class="ml-3 btn btn-primary ">
                        </div>
                    </div>
                </form>
            </div>
            </form>

            <div class="table-responsive-sm">

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Coupon Id</th>
                            <th scope="col">Coupon Code</th>
                            <th scope="col">Discount %</th>
                            <th scope="col">Update</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <?php
                    foreach ($allCoupons as $eachCoupon) {
                    ?>
                    <tbody>

                        <tr>
                            <td>
                                <h5><?= $eachCoupon['id'] ?></h5>
                            </td>
                            <!-- <td></td> -->
                            <td>
                                <?= $eachCoupon['coupon_code'] ?>
                            </td>
                            <td>
                                <?= $eachCoupon['discount'] ?> %
                            </td>

                            <td>
                                <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#myModal<?= $eachCoupon['id'] ?>">
                                    Update
                                </button>
                                <!-- The Modal -->
                                <div class="modal" id="myModal<?= $eachCoupon['id'] ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Update Coupon</h4>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <form action="" method="POST" enctype="multipart/form-data">

                                                    <h4 class="pt-2">Coupon Code </h4>
                                                    <input type="text" name="copName"
                                                        value="<?= $eachCoupon['coupon_code'] ?>" class="form-control"
                                                        required autofocus />
                                                    <br> <input type="tel" name="copDiscount"
                                                        value="<?= $eachCoupon['discount'] ?>" pattern="[0-9]{1,2}"
                                                        class="form-control" required autofocus />
                                                    <br>
                                                    <input type="hidden" name="copId" value="<?= $eachCoupon['id'] ?>">
                                                    <br>
                                                    <input type="submit" name="update" value="Update"
                                                        class="btn btn-primary">
                                                </form>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <form action="" method="POST">
                                    <input type="hidden" name="copId" value="<?= $eachCoupon['id'] ?>">
                                    <input type="submit" name="delete" class="btn btn-danger" value="Delete" id="">
                                </form>
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