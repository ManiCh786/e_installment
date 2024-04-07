<?php
require_once('database.class.php');

class Checkout extends Database
{
    private $orderId;
    private $cName;
    private $cAddress;
    private $cOptionalAddress;
    private $cEmail;
    private $cPhone;
    private $cOrderNotes;
    private $userId;
    private $sellerId;
    private $installmentId;
    private $totalBill;



    public function __construct($_orderId = 0, $_cName = '', $_cAddress = '', $_cOptionalAddress = '', $_cEmail = '', $_cPhone = 0, $_cOrderNotes = '', $_userId = 0, $_sellerId = 0, $_installmentId = 0, $_totalBill = 0)
    {
        parent::__construct();
        $this->orderId = $_orderId;
        $this->cName = $_cName;
        $this->cAddress = $_cAddress;
        $this->cOptionalAddress = $_cOptionalAddress;
        $this->cEmail = $_cEmail;
        $this->cPhone = $_cPhone;
        $this->cOrderNotes = $_cOrderNotes;
        $this->userId = $_userId;
        $this->sellerId = $_sellerId;
        $this->installmentId = $_installmentId;
        // $this->couponCode = $_couponCode;
        // $this->couponPercent = $_couponPercent;
        // $this->subtotal = $_subtotal ;
        $this->totalBill = $_totalBill;
    }
    public function checkoutOrder()
    {

        $orderDate = date("Y/m/d");
        $this->Query('INSERT INTO `orders`(`cName`, `cAddress`, `cOptionalAddress`, `cEmail`, `cPhone`, `cOrderNotes`, `userId`,`sellerId`,`installmentId`, `total`,`orderDate`, `status`) VALUES (:cName,:cAddress,:cOptionalAddress,:cEmail,:cPhone,:cOrderNotes,:userId,:sellerId,:installmentId,:totalBill,:orderDate,:status)');
        $this->Bind(':cName', $this->cName);
        $this->Bind(':cAddress', $this->cAddress);
        $this->Bind(':cOptionalAddress', $this->cOptionalAddress);
        $this->Bind(':cEmail', $this->cEmail);
        $this->Bind(':cPhone', $this->cPhone);
        $this->Bind(':cOrderNotes', $this->cOrderNotes);
        $this->Bind(':userId', $this->userId);
        $this->Bind(':sellerId', $this->sellerId);
        $this->Bind(':orderDate', $orderDate);
        $this->Bind(':totalBill', $this->totalBill);
        $this->Bind(':installmentId', $this->installmentId);
        $this->Bind(':status', 'Pending');
        // installmentId
        if ($this->Run()) {
            $order_id = $this->getlastId();
            $this->Query('select * from cart where userid=:uid');
            $this->Bind(':uid', $this->userId);
            $allcartData = $this->All();
            foreach ($allcartData as $value) {

                $this->Query('INSERT INTO `orderditem`(`orderId`, `proId`,`installmentId`, `itemPrice`,`amtRecieved`, `quantity`) VALUES (:oid,:pid,:installmentId,:price,:amtRecieved,:quan)');
                $this->Bind(':oid', $order_id);
                $this->Bind(':pid', $value['proId']);
                $this->Bind(':price', $value['proPrice']);
                $this->Bind(':installmentId', $value['installmentId']);
                $this->Bind(':amtRecieved', 0);
                $this->Bind(':quan', $value['quantity']);
                if ($this->Run()) {
                    $this->Query('delete  from cart where userid=:uid');
                    $this->Bind(':uid', $this->userId);
                    if ($this->Run()) {
                        echo ('<Script>alert("Your Order Placed Successfuly ! We\'ll Contact You Soon !")</Script>');
                        echo " <script>
                    window.location='thankyou.php';
               </script>";
                    }
                }
            }
        }
    }
    public function loyalUserInfo($user_id = 0)
    {
        $this->Query('SELECT orders.cName,orders.cAddress,orders.cOptionalAddress,orders.cEmail,orders.cPhone FROM `orders` WHERE orders.userId = :uid');
        $this->Bind(':uid', $user_id);
        $allData = $this->All();
        return $allData;
    }
    public function orderhistory($user_id = 0)
    {
        $this->Query('SELECT * FROM `orders` WHERE userId=:uid and status=:status');
        $this->Bind(':uid', $user_id);
        $this->Bind(':status', "shipped");
        $allhistory = $this->All();
        return $allhistory;
    }
    public function itemhistory($order_id = 0)
    {
        $this->Query('SELECT * FROM `orderitem` WHERE order_id=:oid');
        $this->Bind(':oid', $order_id);
        $allitems = $this->All();
        return $allitems;
    }
    public function ViewAllOrders($status,$sellerId='')
    {
        if($sellerId == ""){
            $this->Query('select * from orders JOIN users  where orders.status =:status AND users.userId = orders.userId ORDER BY orders.status ASC');
            $this->Bind(':status', $status);
            $allorder = $this->All();
            return $allorder;
        }else{
            $this->Query('select * from orders JOIN users  where orders.status =:status AND users.userId = orders.userId AND orders.sellerId =:sellerId ORDER BY orders.status ASC');
            $this->Bind(':status', $status);
            $this->Bind(':sellerId', $sellerId);
            $allorder = $this->All();
            return $allorder;
        }
       
    }
    public function ViewOrderItems($order_id)
    {
        
        // $this->Query('SELECT * FROM `orderditem` JOIN products ON orderditem.proId = products.pId WHERE orderditem.orderId=:order_id');
        $this->Query('SELECT * FROM `orderditem`, products,users,installmentplans,orders  WHERE orderditem.orderId= :order_id AND installmentplans.installmentId = orderditem.installmentId AND  orders.sellerId = users.userId AND orderditem.proId = products.pId  LIMIT 1' );
        
        // $this->Bind(':order_id', $order_id);
        $this->Bind(':order_id', $order_id);
        return  $this->All();
    }
    public function checkOrderbyOrderId($order_id)
    {

        $this->Query('SELECT * FROM  orders WHERE  orderId=:order_id');
        $this->Bind(':order_id', $order_id);
        return  $this->All();
    }
    public function shippedOrders()
    {
        $this->Query("SELECT COUNT(orderId) AS NumberOfOrders FROM orders WHERE orders.status =:status");
        $this->Bind(':status', 'shipped');
        if ($this->Total() > 0) {
        }
        return $this->All();
    }
    
    public function newOrders()
    {
        $this->Query("SELECT COUNT(orderId) AS NumberOfOrders FROM orders WHERE orders.status = :status ");
        $this->Bind(':status', 'Pending');

        return $this->All();
    }
    public function deleteOrder()
    {
        $this->Query('DELETE  `orders`,`orderditem` FROM `orders`,`orderditem` WHERE orders.orderId = orderditem.orderId AND orders.orderId = :orderId');
        $this->Bind(':orderId', $this->orderId);

        if ($this->Run()) {

            echo "<script type='text/javascript'>
alert('Order Deleted Succesfully')
</script>";
        }
    }
    public function getRidersOrder($riderId)
    {
        $this->Query('SELECT * FROM `riderorder`, `orders`,`orderditem`,`users` WHERE orders.orderId =riderorder.orderId AND orderditem.orderId = riderorder.orderId AND orders.userId = users.userId AND riderorder.riderId =:riderId');
        $this->Bind(':riderId', $riderId);
        return $this->All();
    }
    public function addInstallment($amtRec)
    {
        $this->Query('UPDATE `orderditem` SET   `amtRecieved`=:amtRec WHERE orderId=:order_id');
        $this->Bind(':amtRec', $amtRec);
        $this->Bind(':order_id', $this->orderId);
        if ($this->Run()) {
                  echo "<script type='text/javascript'>
            alert('Installment Added Succesfully')
            </script>";
        }
    }
    public function UpdateStatus($riderId,$amtToRecieve,$status)
    {
        $this->Query('UPDATE `orders` SET `status`=:_status WHERE orderId=:order_id');
        $this->Bind(':_status', $status);
        $this->Bind(':order_id', $this->orderId);
        if ($this->Run()) {
        //     // echo "<script type='text/javascript'>
        //     // alert('Order Status Changed Succesfully')
        //     // </script>";
        $this->Query('INSERT INTO `riderorder`(`riderId`, `orderId`, `delieveryStatus`, `amountToRecieve`, `amountRecieved`) VALUES (:riderId,:orderId,:delieveryStatus,:amountToRecieve,:amountRecieved)');
        $this->Bind(':riderId', $riderId);
        $this->Bind(':orderId', $this->orderId);
        $this->Bind(':delieveryStatus', $status);
        $this->Bind(':amountToRecieve', $amtToRecieve);
        $this->Bind(':amountRecieved', 0);
        $this->Run();

        }
    }
    public function setToDeliverd($amtToRecieve,$status)
    {
        $this->Query('UPDATE `orders` SET `status`=:_status WHERE orderId=:order_id');
        $this->Bind(':_status', $status);
        $this->Bind(':order_id', $this->orderId);
        if ($this->Run()) {
        $this->Query(' UPDATE `riderorder` SET `delieveryStatus`=:dStatus,`amountRecieved`=:amtRec WHERE riderorder.orderId=:orderId ');
        $this->Bind(':orderId', $this->orderId);
        $this->Bind(':dStatus', $status);
        $this->Bind(':amtRec', $amtToRecieve);
        $this->Run();
        echo " <script>
        window.location='orders.php';
   </script>";
    
    }
    }
}
