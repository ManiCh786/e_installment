<?php

include_once("includes/header.php");
require_once('classes/cart.class.php');
require_once("classes/installmentplans.class.php");

if (isset($_SESSION['Logged_in']) == true) {
  $cart = new Cart();
  $viewCartItems = $cart->displayAllCart();
  $plan = new InstallmentPlans();
  $allPlans = $plan->getInstallmentPlans();
}
if (isset($_POST['updatecart'])) {
  $cartId = $_POST['cartId'];
  $qty = $_POST['qty'];
  if ($qty != 0) {
    $updateCart = $cart->updateCartQty($cartId, $qty);
  } else {
    echo "<script type='text/javascript'>alert('Quantity can't be 0')</script>";
  }


  echo "<script>
  window.location = 'cart.php';
  </script>";
}
if (isset($_POST['deleteCart'])) {
  $cartId = $_POST['cartId'];
  $dltCart = $cart->deleteCartItem($cartId);
  echo "<script>
  window.location = 'cart.php';
  </script>";
}
?>

<main>
  <!-- Hero Area Start-->
  <div class="slider-area ">
    <div class="single-slider slider-height2 d-flex align-items-center">
      <div class="container">
        <div class="row">
          <div class="col-xl-12">
            <div class="hero-cap text-center">
              <h2>Cart List</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--================Cart Area =================-->
  <section class="cart_area section_padding">
    <?php
    if ($viewCartItems != false) {
    ?>
      <div class="container">
        <div class="cart_inner">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th class="product-thumbnail">Image</th>
                  <!-- <th class="product-name">Product</th> -->
                  <th class="product-price">Price</th>
                  <!-- <th class="product-quantity">Quantity</th> -->
                  <th class="product-total">To be Payed Now</th>
                  <th class="product-total">Installment Plan</th>
                  <!-- <th class="product-remove">Update</th> -->
                  <th class="product-remove">Remove</th>

                </tr>
              </thead>
              <?php
              $totalBill = 0;
              foreach ($viewCartItems as $eachItem) {
              ?>

                <tbody>
                  <tr>
                    <td>
                      <div class="media">
                        <div class="d-flex">
                          <img src="uploads/productsImages/<?= $eachItem['proImage'] ?>" alt="Image Not Found" />
                        </div>
                        <div class="media-body">
                          <p><?= $eachItem['proName'] ?></p>
                        </div>
                      </div>
                    </td>
                    <td>


                      <h5><?= $eachItem['proPrice'] ?> PKR</h5>
                    </td>

                    <td>
                      <h5><?= $eachItem['proPrice']  * ($eachItem['downpayment'] / 100)  ?> PKR </h5>
                    </td>
                    <td>
                      <h5><?= $eachItem['title'] ?> </h5>
                    </td>
                    <!--                 
                <td>
                                        <input type="hidden" value="<?= $eachItem['cart_id'] ?>" name="cartId">
                                        <input type="submit" name="updatecart" class="btn btn-success" value="Update">
                                </form>
                                </td> -->
                    <td>
                      <form action="" method="POST">
                        <input type="hidden" value="<?= $eachItem['cart_id'] ?>" name="cartId">
                        <input type="submit" name="deleteCart" class="btn btn-danger height-auto btn-sm" value="X">
                      </form>
                    </td>

                  </tr>



                </tbody>
              <?php

                $totalBill +=   ($eachItem['proPrice']  * ($eachItem['downpayment'] / 100)) * $eachItem['quantity'];
              }
              ?>
              <tr>
                <td></td>
                <td></td>
                <td>
                  <h5>Subtotal</h5>
                </td>
                <td>
                  <h5><?= $totalBill ?> PKR </h5>
                </td>
              </tr>

            </table>
            <div class="checkout_btn_inner float-right">
              <a class="btn_1" href="shop.php">Continue Shopping</a>
              <a class="btn_1 checkout_btn_1" href="checkout.php">Proceed to checkout</a>
            </div>
          </div>
        </div>
      <?php
    } else {

      ?>

        <div class="row">
          <div class="col-3"></div>
          <div class="col-9 mb-5">
            <h3>Your Cart is empty ! Continue Shopping ? </h3>
          </div>
          <div class="col-4"></div>
          <div class="col-lg-6  col-md-6 col-sm-6">

            <div class="input-group-append">
              <div class=" input-group-text continue__btn">
                <a href="shop.php" class="text-dark">Continue Shopping</a>
              </div>

              <div class=" input-group  ml-3">
                <a href="order_history.php" class="btn btn-success">Order History</a>
              </div>
            </div>

          </div>
        </div>

      <?php

    }
      ?>
  </section>
  <!--================End Cart Area =================-->
</main>

<?php

include_once("includes/footer.php");
?>