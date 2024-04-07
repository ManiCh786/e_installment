<?php
require_once("includes/header.php");
if (isset($_SESSION['Logged_in']) && $_SESSION['user_type'] == 'admin') {
    require_once("../classes/user.class.php");
    $user = new User();
    if (isset($_GET['check'])) {
        // $check = 'newuser';
        $userDetails = $user->getAllUsers($_GET['check']);
    } else {
        $userDetails = $user->getAllUsers('');
    }
    if (isset($_POST['AssignRole'])) {
        $userId = $_POST['userId'];
        $userEmail = $_POST['userEmail'];
        $accountType = $_POST['accounttype'];


        $user = new User();
        $userRoles = $user->updateUserRole($userId, $accountType);
    }
    
    if (isset($_POST['deleteUser'])) {
        $userId = $_POST['userId'];
        $user = new User();
        $deleteUser = $user->deleteUser($userId);
    }
    if (isset($_POST['block'])) {
        $userId = $_POST['userId'];
        $accType = "block";
        $user = new User();
        $blockUnblock = $user->blockUnblock($userId,$accType);
    }
    if (isset($_POST['unblock'])) {
        $userId = $_POST['userId'];
        $accType = "unblock";
        $user = new User();
        $blockUnblock = $user->blockUnblock($userId,$accType);
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
                    All Users
                </h4>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">User ID</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Registerd As</th>
                            <th scope="col">Phone</th>
                            <th scope="col">View Details</th>
                            <th scope="col">Delete</th>
                            <th scope="col">Change Role</th>
                            <th scope="col">Block/Unblock</th>



                        </tr>
                    </thead>
                    <?php
                    foreach ($userDetails as $eachDetail) {
                    ?>
                        <tbody>
                            <tr>

                                <td>
                                    <?= $eachDetail['userId'] ?>
                                </td>
                                <td>
                                    <h5><?= $eachDetail['fName'] ?><?= $eachDetail['lName'] ?></h5>
                                </td>
                                <td>
                                    <h5><?= $eachDetail['email'] ?></h5>
                                </td>
                                <td>

                                    <?= $eachDetail['signUpas'] ?>

                                </td>

                                <td>
                                    <?= $eachDetail['mobile'] ?>
                                </td>
                                <td>
                                    <form action="" method="POST">
                                        <a class="btn btn-primary" href="viewmoreuserinfo.php?userId=<?= $eachDetail['userId'] ?>">View More</a>
                                    </form>
                                </td>
                                <td>
                                    <form action="" method="POST">
                                        <input type="hidden" name="userId" value="<?= $eachDetail['userId'] ?>">
                                        <input type="submit" class="btn btn-danger" value="Delete" name="deleteUser">
                                    </form>
                                </td>

                                <td>
                                    <!-- Button to Open the Modal -->
                                    <button type="button" class="btn <?php
                                                                        if ($eachDetail['accountType'] == 'newuser') {

                                                                        ?>btn-success
                                 <?php
                                                                        } else {
                                    ?>
                                    btn-info
                                    <?php  } ?>

                                " data-toggle="modal" data-target="#myModal<?= $eachDetail['userId'] ?>">
                                        <?php
                                        if ($eachDetail['accountType'] == 'newuser') {
                                        ?>
                                            Assign Role
                                        <?php
                                        } else {
                                        ?>
                                            Update Role
                                        <?php  } ?>
                                    </button>
                                    <!-- The Modal -->
                                    <div class="modal" id="myModal<?= $eachDetail['userId'] ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Assign User Role and Login Id</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <h4 class="pt-2">Account Type</h4>
                                                        <select class="select " aria-labelledby="dropdownMenuButton" name="accounttype">
                                                            <option class="dropdown-item" value="admin">Admin</option>
                                                            <option value="user">User</option>
                                                            <option value="seller">Seller</option>
                                                            <option value="rider">Rider</option>
                                                        </select>
                                                        <br>
                                                        <h4 class="pt-2">User Email</h4>
                                                        <input type="text" class="form-control required" name="userEmail" id="" value="<?= $eachDetail['email'] ?>" readonly />
                                                        <br><br>

                                                        <input type="hidden" name="userId" value="<?= $eachDetail['userId'] ?>">
                                                        <input type="hidden" name="userEmail" value="<?= $eachDetail['email'] ?>">
                                                        <br>
                                                        <input type="submit" name="AssignRole" value="Add/Update" class="btn btn-primary" id="">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    
                                    <form action="" method="POST">
                                        <input type="hidden" name="userId" value="<?= $eachDetail['userId'] ?>">
                                        <input type="hidden" name="accType" value="<?= $eachDetail['accountType'] ?>">
                                        <?php
                                        if($eachDetail['accStatus']=="unblock"){

                                        
                                        ?>
                                        <input type="submit" class="btn btn-danger" value="Block" name="block">
                                        <?php
                                        }else{

                                        
                                        ?>
                                        <input type="submit" class="btn btn-success" value="UnBlock" name="unblock">

                                        <?php
                                        }
                                        ?>
                                    
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
</div>






<?php
require_once("includes/footer.php");
?>