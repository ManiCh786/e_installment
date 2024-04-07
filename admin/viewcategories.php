<?php
require_once("includes/header.php");
if (isset($_SESSION['Logged_in']) && $_SESSION['user_type'] == 'admin') {
    require_once("../classes/categories.class.php");
    $cat = new Categories();
    $allCategories = $cat->viewAllCategories();

    if (isset($_POST['addcategory'])) {
        $catName = $_POST['CatName'];
        if ($catName != '') {
            $cat = new Categories(0, $catName);
            $addCat = $cat->AddCategory();
            echo "<script>
          window.location = 'viewcategories.php';
           </script>";
        } else {
            echo ('<script>alert("Category Name Is Empty")</script>');
        }
    }
    if (isset($_POST['update'])) {
        $catid = $_POST['catId'];
        $catName = $_POST['categoryName'];

        if ($catName != '') {
            $update = new Categories($catid, $catName);
            $update->updateCategory();
            echo "<script>
         window.location = 'viewcategories.php';
         </script>";
        } else {
            echo '<script type="text/javascript"> setTimeout(function () { swal({
            title: "Error!",
            text: "Enter Category Name To Update",
            icon: "error",
            button: "OK",
          }); }, 1000 );</script>';
        }
    }
    if (isset($_POST['delete'])) {
        $catid = $_POST['catId'];
        $delcat = new Categories($catid);
        $delete = $delcat->deleteCategory();
        echo "<script>
    window.location = 'viewcategories.php';
    </script>";
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
                    Categories
                </h4>
            </div>
            <div class="col-12 col-md-8 input-group mb-3">
                <form action="" method="POST">
                    <div class="input-group mb-3">
                        <input type="text" name="CatName" placeholder="Enter Category Name" class="form-control"
                            required />
                        <div class="input-group-append">
                            <input type="submit" name="addcategory" value="Add Category" class="ml-3 btn btn-primary ">
                        </div>
                    </div>
                </form>
            </div>
            </form>
            <div class="col-6 col-md-12 ">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Category Id</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">View Products</th>
                            <th scope="col">Update</th>
                            <th scope="col">Delete</th>
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
                            <td>
                                <a class="btn btn-primary" href="product.php?cat_id=<?= $eachCategory['cat_id'] ?>">View
                                    Products</a>
                            </td>
                            <td>
                                <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#myModal<?= $eachCategory['cat_id'] ?>">
                                    Update
                                </button>
                                <!-- The Modal -->
                                <div class="modal" id="myModal<?= $eachCategory['cat_id'] ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Update Category</h4>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <form action="" method="POST" enctype="multipart/form-data">
                                                    <!-- <h4 class="pt-2">Category Id</h4> -->
                                                    <!-- <input type="text" value="<?= $eachCategory['cat_id'] ?>"
                                                        class="form-control " readonly />
                                                    <br> -->
                                                    <h4 class="pt-2">Category Name</h4>
                                                    <input type="text" name="categoryName"
                                                        value="<?= $eachCategory['cat_Name'] ?>" class="form-control"
                                                        required autofocus />
                                                    <br>
                                                    <input type="hidden" name="catId"
                                                        value="<?= $eachCategory['cat_id'] ?>">
                                                    <br>
                                                    <input type="submit" name="update" value="Update"
                                                        class="btn btn-primary">
                                                </form>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <form action="" method="POST">
                                    <input type="hidden" name="catId" value="<?= $eachCategory['cat_id'] ?>">
                                    <input type="submit" name="delete" class="btn btn-danger" value="Delete" id="">
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


    <?php
    require_once("includes/footer.php");
    ?>