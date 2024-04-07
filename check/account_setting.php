<?php
require_once("includes/header.php");
if (isset($_SESSION['Logged_in']) && $_SESSION['user_type'] == 'seller') {
    require_once('../classes/user.class.php');
    $users = new User();
    $totalUsers = $users->totalUsers();
    $userDetails = $users->getLoggedInUserInformation($_SESSION['User_id']);
    if (isset($_POST['update'])) {
        $userId = $_POST['userId'];
        $fName = $_POST['firstName'];
        $lName = $_POST['lastName'];
        $shopName =$_POST['shopName'];
        $email =$_POST['email'];
        $mobile =$_POST['mobile'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $email = $_POST['email'];
        
            if ($confirmPassword == $password) {
                $updateUser =   new User(
                    $userId,
                    $fName,
                    $lName,
                    0,
                    $mobile,
                    "",
                    "",
                    0,
                    "",
                    "",
                    "",
                    "",
                    0,
                    $shopName,
                    $password,
                );
        echo($userId);


                $update = $updateUser->updateSellerInfo();
            //     echo "<script>
            // window.location = 'account_setting.php';
            // </script>";
            } else {
                echo "<script type='text/javascript'>alert('Passwords do not match ! Try Again ')</script>";
            }
        
    
} }else {
    echo "<script>
            window.location = '../logout.php';
              </script>";
}

?>
<script>
function showConfirmPasswordFiekd() {

    var confirmPasswordField = document.getElementById('confirmPassword');
    confirmPasswordField.value = "";
    confirmPasswordField.style.display = "block";

}



function showPassword() {
    var password = document.getElementById('password');
    var show_eye_icon = document.getElementById('show_eye');
    var hide_eye_icon = document.getElementById('hide_eye');
    hide_eye.classList.remove("d-none");

    hide_eye_icon.style.display = "none";
    show_eye_icon.style.display = "block";
    if (password.type == "password") {
        // password.innerHTMl="text";
        password.type = "text";
        hide_eye_icon.style.display = "block";
        show_eye_icon.style.display = "none";
    } else {
        password.type = "password";
        hide_eye_icon.style.display = "none";
        show_eye_icon.style.display = "block";
    }
}
</script>

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">
                    My Profile
                </h4>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?php
                    foreach ($userDetails as $eachDetail) {
                    ?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="userId" value="<?= $eachDetail['userId'] ?>">
                        <input type="text" name="firstName" placeholder="First Name" class="form-control"
                            value="<?= $eachDetail['fName'] ?>">
                        <br>
                        <input type="text" name="lastName" placeholder="Last Name" class="form-control"
                            value="<?= $eachDetail['lName'] ?>">
                        <br>

                        <input type="text" name="shopName" placeholder="Shop Name" class="form-control"
                            value="<?= $eachDetail['shopName'] ?>" />
                        <br>
                        <input type="phone" name="mobile" placeholder="Phone Number" class="form-control"
                            value="<?= $eachDetail['mobile'] ?>" />
                        <br>
                        <input  type="email" name="email" placeholder="Email" class="form-control text-dark"
                            value="<?= $eachDetail['email'] ?>" readonly />
                        <br>
                        <div class="input-group">

                            <input type="password" name="password" id="password" onkeyup="showConfirmPasswordFiekd();"
                                placeholder="Password" class="form-control" value="<?= $eachDetail['password'] ?>">

                            <div class="input-group-append">
                                <span class="input-group-text" onclick="showPassword();">
                                    <i class="mdi mdi-eye " id="show_eye"></i>
                                    <i class="mdi mdi-eye-off d-none" id="hide_eye"></i>
                                </span>
                            </div>
                        </div>
                        <br>
                        <input type="text" style="display:none;" id="confirmPassword" name="confirmPassword"
                            placeholder="Confirm your Password" class="form-control"
                            value="<?= $eachDetail['password'] ?>" />

                        <br>
                        <label class="mt-3" for="">User Type</label>

                        <div class="d-flex">
                            <input type="text" name="account_type" placeholder="Type" class="bg-dark form-control"
                                value="<?= $eachDetail['accountType'] ?>" readonly>
                        </div>
                        
                        

                        <input type="submit" value="Update" name="update" class="btn btn-block btn-lg bg-success mt-3">

                    </form>
                    <?php
                    }
                    ?>
                </div>
                <div class="col-md-6"></div>
            </div>

        </div>
    </div>
    <!-- </div> -->


    <?php
    require_once("includes/footer.php");
    ?>