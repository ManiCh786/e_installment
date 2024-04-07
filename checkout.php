<?php

include_once("includes/header.php");

if (isset($_SESSION['Logged_in']) == true) {
  require_once('classes/order.class.php');
  require_once('classes/cart.class.php');
  $cart = new Cart();
  $viewCartItems = $cart->displayAllCart();
  $userId = $_SESSION['User_id'];
  $checkout = new Checkout();
  // $loyalUserInformation = $checkout->loyalUserInfo($userId);
  if (isset($_POST['placeorder'])) {
    $c_name = $_POST['c_Name'];
    $c_address = $_POST['c_address'];
    $c_address_optional = $_POST['c_address_optional'];
    $c_email = $_POST['c_email_address'];
    $c_phone = $_POST['c_phone'];
    $c_ordernotes = $_POST['c_order_notes'];
    $totalBill = $_POST['totalBill'];
    $sellerId = $_POST['sellerId'];
    $installmentId = $_POST['installmentId'];

    $checkout = new Checkout(0, $c_name, $c_address, $c_address_optional, $c_email, $c_phone, $c_ordernotes, $userId, $sellerId, $installmentId, $totalBill);
    $placeOrder = $checkout->checkoutOrder();
  }
} else {
  echo "<script>
  window.location = 'login.php';
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
              <h2>Checkout</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--================Checkout Area =================-->
  <section class="checkout_area section_padding">
    <div class="container">
      <!--      
      <div class="cupon_area">
        <div class="check_title">
          <h2>
            Have a coupon?
            <a href="#">Click here to enter your code</a>
          </h2>
        </div>
        <input type="text" placeholder="Enter coupon code" />
        <a class="tp_btn" href="#">Apply Coupon</a>
      </div> -->
      <div class="billing_details">
        <div class="row">

          <div class="col-lg-8">
            <form action="" method="POST">

              <h2 class="h3 mb-3 text-black">Billing Details</h2>

              <div class="p-3 p-lg-5 border">

                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="fNaame" class="text-black">Full Name <span class="text-danger">*</span></label>
                    <input type="text" value="<?= $loyalUserInformation[0]['cName'] ?? '' ?>" class="form-control" id="" name="c_Name" required>
                  </div>

                </div>


                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_addreess" class="text-black">Address <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="c_address" required placeholder="Street address" value="<?= $loyalUserInformation[0]['cAddress'] ?? '' ?>">
                  </div>
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" name="c_address_optional" value="<?= $loyalUserInformation[0]['cOptionalAddress'] ?? '' ?>" placeholder="House Number,Apartment, Office etc. (optional)">
                </div>
                <div class="form-group ">

                  <label for="c_email_addreess" class="text-black">Email Address <span class="text-danger">*</span></label>
                  <input type="email" class="form-control" placeholder="Email" required name="c_email_address" value="<?= $loyalUserInformation[0]['cEmail'] ?? '' ?>">
                </div>

                <div class="form-group row mb-5">
                  <div class="col-md-12">
                    <label for="c_phonee" class="text-black">Phone <span class="text-danger">*</span></label>
                    <input type="tel" class="form-control" name="c_phone" required value="<?= $loyalUserInformation[0]['cPhone'] ?? '' ?>" placeholder="Phone Number" pattern="^03\d{9}$">
                  </div>
                </div>
                <div class="form-group">
                  <label for="c_orderr_notes" class="text-black">Order Notes</label>
                  <textarea name="c_order_notes" name="c_order_notes" cols="30" rows="5" class="form-control" placeholder="Write your notes here..."></textarea>
                </div>

              </div>
          </div>
          <div class="col-lg-4">
            <div class="order_box">
              <h2>Your Order</h2>
              <ul class="list">
                <li>
                  <a href="#">Product
                    <span>Total</span>
                  </a>
                </li>
                <?php
                if ($viewCartItems != null) {
                  $totalBill = 0;

                  foreach ($viewCartItems as $eachCart) {
                ?>
                    <li>
                      <a href="#"> <?= $eachCart['proName'] ?>
                        <span class="middle">x <?= $eachCart['quantity'] ?></span>
                        <span class="last"><?= ($eachCart['proPrice'] * ($eachCart['downpayment'] / 100)) * $eachCart['quantity'] ?> PKR</span>
                      </a>
                      <input type="hidden" name="sellerId" value="<?= $eachCart['sellerId'] ?>">
                      <input type="hidden" name="installmentId" value="<?= $eachCart['installmentId'] ?>">
                    </li>
                <?php
                    $totalBill +=  ($eachCart['proPrice']  * ($eachCart['downpayment'] / 100)) * $eachCart['quantity'];
                  }
                }

                ?>
              </ul>
              <ul class="list list_2">
                <li>
                  <a href="#">Subtotal
                    <span><?= $totalBill ?> PKR </span>
                  </a>
                </li>
              </ul>
              <input type="hidden" name="totalBill" value="<?= $totalBill ?>">
              <input type="submit" name="placeorder" class="mt-5 btn_3" value="Checkout">

              <!-- <a class="mt-5 btn_3" href="#">Checkout</a> -->
            </div>
          </div>

          </form>
        </div>
      </div>
    </div>
  </section>
  <!--================End Checkout Area =================-->
</main>
<?php

include_once("includes/footer.php");
?>