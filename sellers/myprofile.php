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
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $cnic = $_POST['cnicno'];
        $occupation = $_POST['occupation'];
        $monthlyIncome = $_POST['monthlyIncome'];
        $cnicFront = $_POST['cnicFront'];
        $cnicBack = $_POST['cnicBack'];
        if ($_FILES['cnicFrontImage']['size'] != 0) {
            $cnicFrontPic = $_FILES['cnicFrontImage']['name'];
            move_uploaded_file($_FILES['cnicFrontImage']['tmp_name'], "../uploads/usersIDCardPics/" . $cnicFrontPic);
            $updateUser = new User($userId,
                $fName,
                $lName,
                $cnic,
                $phone,
                $email,
                $occupation,
                $monthlyIncome,
                $address,
                $cnicFrontPic,
                $cnicBack,
                "",
                0,
                "",
                $password,
            );
            $update = $updateUser->updateUserInfo();
        } else if ($_FILES['cnicBackImage']['size'] != 0) {
            $cnicBackPic = $_FILES['cnicBackImage']['name'];
            move_uploaded_file($_FILES['cnicBackImage']['tmp_name'], "../uploads/usersIDCardPics/" . $cnicBackPic);
            $updateUser = new User(
                $userId,
                $fName,
                $lName,
                $cnic,
                $phone,
                $email,
                $occupation,
                $monthlyIncome,
                $address,
                $cnicFront,
                $cnicBackPic,
                "",
                0,
                "",
                $password,
            );
            $update = $updateUser->updateUserInfo();
        } else {
            if ($confirmPassword == $password) {
                $updateUser =   new User(
                    $userId,
                    $fName,
                    $lName,
                    $cnic,
                    $phone,
                    $email,
                    $occupation,
                    $monthlyIncome,
                    $address,
                    $cnicFront,
                    $cnicBack,
                    "",
                    0,
                    "",
                    $password,
                );
                $update = $updateUser->updateUserInfo();
                echo "<script>
            window.location = 'myprofile.php';
            </script>";
            } else {
                echo "<script type='text/javascript'>alert('Passwords do not match ! Try Again ')</script>";
            }
        }
    }
} else {
    echo "<script>
            window.location = '../logout.php';
              </script>";
}
?>
<script>
    function showHidePassword() {
        var password = document.getElementById('password1');
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

    function showConfirmPasswordFiekd() {

        var confirmPasswordField = document.getElementById('confirmPassword');
        confirmPasswordField.value = "";
        confirmPasswordField.style.display = "block";

    }
</script>
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


                            <input type="text" name="firstName" placeholder="First Name" class="form-control" value="<?= $eachDetail['fName'] ?>">
                            <br>
                            <input type="text" name="lastName" placeholder="Last Name" class="form-control" value="<?= $eachDetail['lName'] ?>">
                            <br>
                            <div class="input-group">

                                <input type="password" name="password" id="password1" placeholder="Password" onkeyup="showConfirmPasswordFiekd();" class="form-control" value="<?= $eachDetail['password'] ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="showHidePassword();">
                                        <i class="mdi mdi-eye " id="show_eye"></i>
                                        <i class="mdi mdi-eye-off d-none" id="hide_eye"></i>
                                    </span>
                                </div>
                            </div>

                            <br>

                            <input type="password" style="display:none;" id="confirmPassword" name="confirmPassword" placeholder="Confirm your Password" class="form-control" value="<?= $eachDetail['password'] ?>">

                            <br>
                            <input type="email" name="email" placeholder="Email" class="form-control" value="<?= $eachDetail['email'] ?>" />
                            <br>
                            <input type="text" name="phone" placeholder="Phone No" class="form-control" value="<?= $eachDetail['mobile'] ?>">
                            <br>
                            <input type="text" name="address" placeholder="Address" class="form-control" value="<?= $eachDetail['address'] ?>">
                            <br>
                            <input type="text" name="cnicno" placeholder="CNIC" class="form-control" value="<?= $eachDetail['cnic'] ?>" />
                            <br>
                            <br>
                            <input type="text" name="occupation" placeholder="Occupation" class="form-control" value="<?= $eachDetail['occupation'] ?>" />
                            <br>
                            <input type="text" name="ntnno" placeholder="NTN number" class="form-control" value="<?= $eachDetail['ntnno'] ?>" />

                            <br>

                            <label for="">User Type</label>
                            <div class="d-flex">
                                <input type="text" name="account_type" placeholder="Type" class="form-control" value="<?= $eachDetail['accountType'] ?>" readonly>
                            </div>


                            <br>
                            <label for="">CNIC Front </label>
                            <img src="../uploads/usersIDCardPics/<?= $eachDetail['cnicFront'] ?>" alt="Not Found" class="img-thumbnail" width="50%">
                            <input type="hidden" name="cnicFront" value="<?= $eachDetail['cnicFront'] ?>">

                            <br>
                            <input type="file" name="cnicFrontImage" class="form-control">
                            <br>
                            <br>
                            <label for="">CNIC Back</label>
                            <img src="../uploads/usersIDCardPics/<?= $eachDetail['cnicBack'] ?>" alt="Not Found" class="img-thumbnail" width="50%">
                            <br>
                            <input type="hidden" name="cnicBack" value="<?= $eachDetail['cnicBack'] ?>">
                            <input type="file" name="cnicBackImage" class="form-control">
                            <br>
                            <input type="hidden" name="userId" value="<?= $eachDetail['userId'] ?>">
                            <input type="submit" name="update" value="Update" class="btn btn-primary">

                        </form>
                    <?php
                    }
                    ?>
                </div>
                <div class="col-md-6"></div>
            </div>

        </div>
    </div>
</div>


<?php
require_once("includes/footer.php");
?>