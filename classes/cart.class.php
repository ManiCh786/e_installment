<?php
require_once('database.class.php');
class Cart extends Database
{
    private $cartId;
    private $proName;
    private $proDesc;
    private $proImage;
    private $proPrice;
    private $userId;
    private $proId;
    private $sellerId;
    private $qty;
    private $installmentId;
    public function __construct($_cartId = 0, $_proName = '', $_proDesc = '', $_proImage = '', $_proPrice = 0, $_userId = 0, $_proId = 0,$_sellerId = 0, $_qty = 0, $_installmentId = 0)
    {
        parent::__construct();
        $this->cartId = $_cartId;
        $this->proName = $_proName;
        $this->proDesc = $_proDesc;
        $this->proImage = $_proImage;
        $this->proPrice = $_proPrice;
        $this->userId = $_userId;
        $this->proId = $_proId;
        $this->sellerId = $_sellerId;
        $this->qty = $_qty;
        $this->installmentId = $_installmentId;
    }
    public function addToCart()
    {
        $this->Query("SELECT * FROM `cart` WHERE proId = :proId AND userid = :userId AND installmentId = :installId");
        $this->Bind(':proId', $this->proId);
        $this->Bind(':userId', $this->userId);
        $this->Bind(':installId', $this->installmentId);
        if ($this->Total()) {
            echo '<script>alert("This Product Already Exits in Cart")</script>';
            echo "<script>
             window.location = 'cart.php';
                </script>";
        } else {

            $this->Query("INSERT INTO `cart`  (`proName`, `proDesc`, `proImage`, `proPrice`, `userid`, `proId`, `sellerId`, `quantity`, `installmentId`) VALUES 
            (:proName,:proDesc,:proImage,:proPrice,:userId,:proId,:sellerId,:qty,:installmentId)");
            $this->Bind(':proName', $this->proName);
            $this->Bind(':proDesc', $this->proDesc);
            $this->Bind(':proImage', $this->proImage);
            $this->Bind(':proPrice', $this->proPrice);
            $this->Bind(':userId', $this->userId);
            $this->Bind(':proId', $this->proId);
            $this->Bind(':sellerId', $this->sellerId);
            $this->Bind(':qty', $this->qty);
            $this->Bind(':installmentId', $this->installmentId);
            if ($this->Run()) {
                echo '<script>alert("Product Added to Cart")</script>';
                echo "<script>
            window.location = 'shop.php';
            </script>";
            }
        }
    }
    public function totalItems()
    {
        $userId = $_SESSION['userId'] ?? 0;
        $this->Query("SELECT COUNT(cart_id) AS totalItems FROM cart WHERE  userid = :userId ");
        $this->Bind(':userId', $userId);
        return $this->All();
    }
    public function displayAllCart()
    {
        // $this->Query('SELECT * FROM cart where userid=:userId');
        $this->Query('SELECT * FROM cart,installmentplans where cart.installmentId = installmentplans.installmentId  AND userid =:userId');
        $this->Bind(':userId', $_SESSION['User_id']);
        if ($this->Total()) {
            return $this->All();
        } else {
            return false;
        }
    }
    public function deleteCartItem($cart_id)
    {
        $this->Query('delete  from cart where cart_id=:cartid');
        $this->Bind(':cartid', $cart_id);
        if ($this->Run()) {
            echo "<script type='text/javascript'>alert('Product Deleted Succesfully')</script>";
        }
    }
    public function updateCartQty($cartId, $qty)
    {
        $this->Query("UPDATE `cart` SET `quantity`= :qty WHERE cart_id = :cartId");
        $this->Bind(':cartId', $cartId);
        $this->Bind(':qty', $qty);
        if ($this->Run()) {
            echo '<script>alert(" Product Updated in cart !")</script>';
        }
    }
    public function applyCoupon($couponCode)
    {
        $this->Query("SELECT coupon_code,discount FROM coupons WHERE coupon_code =:couponCode");
        $this->Bind(':couponCode', $couponCode);
        if ($this->Total()) {
            return $this->All();
        } else {
            echo "<script type='text/javascript'>alert('Invalid Coupon Code !')</script>";
            return false;
        }
    }
}