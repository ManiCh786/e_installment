<?php
require_once("includes/header.php");
if (isset($_SESSION['Logged_in']) && $_SESSION['user_type'] == 'admin') {
    require_once("../classes/user.class.php");
    $userId = $_GET['userId'];
    $user = new User();
    $userInfo = $user->getLoggedInUserInformation($userId);
} else {
    echo "<script>
    window.location = '../login.php';
    </script>";
}
?>
<script>
    // Get the img object using its Id
    img = document.getElementById("img1");
    // Function to increase image size
    function enlargeImg() {
        // Set image size to 1.5 times original
        img.style.transform = "scale(1.5)";
        // Animation effect
        img.style.transition = "transform 0.25s ease";
    }
    // Function to reset image size
    function resetImg() {
        // Set image size to original
        img.style.transform = "scale(1)";
        img.style.transition = "transform 0.25s ease";
    }
</script>



<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">
                    User Details
                </h4>

            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">CNIC Image(FRONT)</th>
                        <th scope="col">CNIC Image(BACK)</th>
                        <th scope="col">CNIC No</th>
                        <th scope="col">Occupation</th>
                        <th scope="col">NTN NO</th>
                        <th scope="col">Address</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Shop Name</th>

                    </tr>
                </thead>
                <?php
                foreach ($userInfo as $eachInfo) {
                ?>
                    <tbody>

                        <tr>

                            <td>
                                <img style="height: 100px" src="../uploads/usersIDCardPics/<?= $eachInfo['cnicFront'] ?>" class="img-fluid rounded-3" onclick="enlargeImg();" id="img1" alt="Image Not Found">
                            </td>
                            <td>
                                <img style="height: 100px" src="../uploads/usersIDCardPics/<?= $eachInfo['cnicBack'] ?>" class="img-fluid rounded-3" alt="Image Not Found">
                            </td>

                            <td>
                                <h5><?= $eachInfo['cnic'] ?></h5>
                            </td>

                            <td>
                                <h5><?= $eachInfo['occupation'] ?></h5>

                            </td>
                            <td>
                                <h5><?= $eachInfo['ntnno'] ?></h5>
                            </td>
                            <td>
                                <h5><?= $eachInfo['address'] ?></h5>
                            </td>

                            <td>
                                <h5><?= $eachInfo['mobile'] ?></h5>
                            </td>
                            <td>
                                <h5><?= $eachInfo['shopName'] ?></h5>
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