<?php
require_once("includes/header.php");
if (isset($_SESSION['Logged_in']) && $_SESSION['user_type'] == 'seller') {
    require_once("../classes/categories.class.php");
    $cat = new Categories();
    $allCategories = $cat->viewAllCategories();

   
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
                    Categories
                </h4>
            </div>
         
            <div class="col-6 col-md-12 ">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Category Id</th>
                            <th scope="col">Category Name</th>
                         
                        </tr>
                    </thead>
                    <?php
                    foreach ($allCategories as $eachCategory) {
                    ?>
                    <tbody>

                        <tr>
                            <td>
                                <h5><?= $eachCategory['cat_id'] ?></h5>
                            </td>
                            <!-- <td></td> -->
                            <td>
                                <?= $eachCategory['cat_Name'] ?>
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