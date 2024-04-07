<?php
require_once('database.class.php');
class User extends Database
{
    private $userId;
    private $fname;
    private $lname;
    private $cnic;
    private $mobile;
    private $email;
    private $occupation;
    private $ntnno;
    private $address;
    private $cnicFront;
    private $cnicBack;
    private $accountType;
    private $accStatus;
    private $signUpas;
    private $shopName;
    private $password;


    public function __construct(
        $_userId = 0,
        $_fname = '',
        $_lname = '',
        $_cnic = '',
        $_mobile = '',
        $_email = '',
        $_occupation = '',
        $_ntnno = 0,
        $_address = '',
        $_cnicFront = '',
        $_cnicBack = '',
        $_accountType = '',
        $_accStatus ='',
        $_signUpas = '',
        $_shopName = '',
        $_password = ''

    ) {
        parent::__construct();
        $this->userId = $_userId;
        $this->fname = $_fname;
        $this->lname = $_lname;
        $this->cnic = $_cnic;
        $this->mobile = $_mobile;
        $this->email = $_email;
        $this->occupation = $_occupation;
        $this->ntnno = $_ntnno;
        $this->address = $_address;
        $this->cnicFront = $_cnicFront;
        $this->cnicBack = $_cnicBack;
        $this->accountType = $_accountType;
        $this->accStatus = $_accStatus;
        $this->signUpas = $_signUpas;
        $this->shopName = $_shopName;
        $this->password = $_password;
    }
    public function Login($email, $password)
    {
        $this->Query('select * from users where email=:email');
        $this->Bind(':email', $email);
        if ($this->Total()) {
            $this->Query('select * from users where email=:email and password=:pwd');
            $this->Bind(':email', $email);
            $this->Bind(':pwd', $password);
            if ($this->Total()) {
                $user = $this->Single();
                $_SESSION['Logged_in'] = true;
                $_SESSION['User_id'] = $user['userId'];
                $_SESSION['fullName'] = $user['fName'] . $user['lName'];
                $_SESSION['user_type'] = $user['accountType'];
                if ($_SESSION['user_type'] == 'user') {
                    echo '<script>alert("You are Logged In Succesfully")</script>';
                    echo "<script>
                    window.location = 'index.php';
                    </script>";
                }
                if ($_SESSION['user_type'] == 'admin') {

                    echo '<script>alert("Welcome Admin")</script>';
                    echo "<script>
                 window.location = 'admin/index.php';
                  </script>";
                }
                if ($_SESSION['user_type'] == 'seller') {
                    echo '<script>alert("Welcome Seller")</script>';
                    echo "<script>
                 window.location = 'sellers/index.php';
                  </script>";
                } if ($_SESSION['user_type'] == 'rider') {
                    echo '<script>alert("Welcome Rider")</script>';
                    echo "<script>
                 window.location = 'rider/index.php';
                  </script>";
                }
                else {
                    echo '<script>alert("You are not Verified Yet ! We Are Sorry for the Incovenience :(")</script>';
                }
            } else {

                echo '<script>alert("Your Password is Incorect !")</script>';
            }
        } else {
            echo '<script>alert("This email does not Exits !")</script>';
        }
    }
    public function Signup()
    {
        $this->Query('select * from users where email=:eml');
        $this->Bind(':eml', $this->email);
        if ($this->Total()) {
            echo '<script>alert("This Email Already Exits !")</script>';
            return 0;
        } else {
            $this->Query('INSERT INTO `users`(`fName`, `lName`, `cnic`, `mobile`, `email`, `occupation`, `ntnno`, `address`, `cnicFront`, `cnicBack`, `accountType`, `signUpas`,`shopName`, `password`) VALUES (:fname,:lname,:cnic,:mobile,:email,:occupation,:ntnno,:address,:cnicFront,:cnicBack,:accountType,:signUpas,:shopName,:password)');
            $this->Bind(':fname', $this->fname);
            $this->Bind(':lname', $this->lname);
            $this->Bind(':cnic', $this->cnic);
            $this->Bind(':mobile', $this->mobile);
            $this->Bind(':email', $this->email);
            $this->Bind(':occupation', $this->occupation);
            $this->Bind(':ntnno', $this->ntnno);
            $this->Bind(':address', $this->address);
            $this->Bind(':cnicFront', $this->cnicFront);
            $this->Bind(':cnicBack', $this->cnicBack);
            $this->Bind(':accountType', $this->accountType);
            $this->Bind(':signUpas', $this->signUpas);
            $this->Bind(':shopName', $this->shopName);
            $this->Bind(':password', $this->password);
            if ($this->Run()) {
                echo ('<Script>alert("Your Request is Recieved. You are being verified Now !")</Script>');
                echo "<script>
          window.location = 'index.php';
          </script>";
                return 1;
            } else {
                echo ('<Script>alert("Error ! Try Again Later")</Script>');
            }
        }
    }
    public function totalUsers()
    {
        $this->Query("SELECT COUNT(userId) AS NumberOfUsers FROM users WHERE   :flag ");
        $this->Bind(':flag', 1);
        return $this->All();    
    }

    public function newUsers()
    {
        $this->Query("SELECT COUNT(userId) AS NumberOfUsers FROM users WHERE users.accountType=:accType ");
        $this->Bind(':accType', 'newuser');
        return $this->All();
    }
    public function totalSellers()
    {
        $this->Query("SELECT COUNT(userId) AS NumberOfUsers FROM users WHERE users.accountType=:accType ");
        $this->Bind(':accType', 'seller');
        return $this->All();
    }
    public function totalRiders()
    {
        $this->Query("SELECT COUNT(userId) AS NumberOfUsers FROM users WHERE users.accountType=:accType ");
        $this->Bind(':accType', 'rider');
        return $this->All();
    }
    public function updateUserRole($userId, $accountType)
    {
        $this->Query('SELECT * FROM `users` WHERE userId =:userId');
        $this->Bind(':userId', $userId);
        if ($this->Total()) {
            $data = $this->Single();
            // $checkIsNewUser = $data['accountType'];
            // if ($checkIsNewUser == 'newuser') {
            $this->Query('UPDATE `users` SET `accountType`= :accounttype WHERE userId = :userId');
            $this->Bind(':userId', $userId);
            $this->Bind(':accounttype', $accountType);
            if ($this->Run()) {
                echo "<script>
      window.location = 'usersmanagement.php';
      </script>";
            }
        }
    }
    public function getLoggedInUserInformation($user_id)
    {
        $this->Query('SELECT * FROM  `users`  where userId=:userId');
        $this->Bind(':userId', $user_id);
        if ($this->Total()) {
            return $this->All();
        } else {
            return 0;
        }
    }

    public function getAllUsers($check)
    {
        if($check != null){
            $this->Query('SELECT * FROM `users`  where accountType=:accountType ORDER BY userId DESC');
            $this->Bind(':accountType', $check);
            $this->Total();
            return $this->All();
        }else{
            $this->Query('SELECT * FROM `users`  where :flag ORDER BY userId DESC');
            $this->Bind(':flag', 1);
            return $this->All();
        }
    }
    public function deleteUser($userId)
    {
        $this->Query('DELETE FROM `users` where userId =:userId');
        $this->Bind(':userId', $userId);
        if ($this->Run()) {
            echo '<script type="text/javascript"> setTimeout(function () { swal({
        title: "Success!",
        text: "User Deleted Succesfully !",
        icon: "success",
        button: "OK",
      }); }, 1000);</script>';
            echo "<script>
      window.location = 'usersmanagement.php';
      </script>";
        } else {
            return 0;
        }
    }
    public function blockUnblock($userId,$accType){
        $this->Query("UPDATE `users` SET `accStatus`=:acctType WHERE userId =:userId");
        $this->Bind(':acctType', $accType);
        $this->Bind(':userId', $userId);

        if ($this->Run()) {

            echo "<script type='text/javascript'>alert('Operation Succesfully')</script>";
        } else {
        
            echo "<script type='text/javascript'>alert('Error Occured !')</script>";
        } 
    }
    public function updateUserInfo()
    {

        $this->Query("UPDATE `users` SET 
        `fName`= :fname,
        `lName`=:lname,
        `cnic`=:cnic,
        `mobile`=:mobile,
        `email`=:email,
        `occupation`=:occupation,
        `ntnno`=:ntnno,
        `address`=:address,
        `cnicFront`=:cnicFront,
        `cnicBack`=:cnicBack,
        `password`=:password WHERE userId =:userId");

        $this->Bind(':userId', $this->userId);
        $this->Bind(':password', $this->password);
        $this->Bind(':fname', $this->fname);
        // $this->Bind(':fname', "Umaar");
        $this->Bind(':lname', $this->lname);
        $this->Bind(':cnic', $this->cnic);
        $this->Bind(':email', $this->email);
        $this->Bind(':occupation', $this->occupation);
        $this->Bind(':ntnno', $this->ntnno);
        $this->Bind(':address', $this->address);
        $this->Bind(':cnicFront', $this->cnicFront);
        $this->Bind(':cnicBack', $this->cnicBack);
        $this->Bind(':mobile', $this->mobile);
        if ($this->Run()) {

            echo "<script type='text/javascript'>alert('Updated Succesfully')</script>";
        } else {
        
           
        }
    }
    public function updateSellerInfo(){
        // echo($this->userId);
        // echo "<script type='text/javascript'>alert('Passwords do not match ! Try Again ')</script>";
        // echo "<script type='text/javascript'>alert('$this->shopName')</script>";
        // echo "<script type='text/javascript'>alert('$this->userId')</script>";
        // echo "<script type='text/javascript'>alert('$this->fname')</script>";
        // echo "<script type='text/javascript'>alert('$this->lname')</script>";
        // echo "<script type='text/javascript'>alert('$this->mobile')</script>";
        // echo "<script type='text/javascript'>alert('$this->password')</script>";




        $this->Query("UPDATE `users` SET `fName`:fname,`lName`=:lname,`mobile`= :mobile,`shopName`=:shopName,`password`=:password WHERE userId =:userId");
       $this->Bind(':fname', $this->fname);
       $this->Bind(':lname', $this->lname);
       $this->Bind(':mobile', $this->mobile);
       $this->Bind(':shopName', $this->shopName);
       $this->Bind(':password', $this->password);
       $this->Bind(':userId', $this->userId);
       if ($this->Run()) {

        echo "<script type='text/javascript'>alert('Updated Succesfully')</script>";
    } else {
    
        echo "<script type='text/javascript'>alert('Error Occured !')</script>";
       
    }
    }
}
