<?php
require_once("includes/header.php");
if (isset($_SESSION['Logged_in']) && $_SESSION['user_type'] == 'seller') {
    require_once("../classes/user.class.php");
    $user = new User();
    $userDetails = $user->getAllUsers('rider');
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
                            <th scope="col">Address</th>
                           



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
                                    <?= $eachDetail['address'] ?>
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