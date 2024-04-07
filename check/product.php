<?php
require_once("includes/header.php");
if (isset($_SESSION['Logged_in']) && $_SESSION['user_type'] == 'seller') {
    require_once("../classes/products.class.php");
    require_once("../classes/categories.class.php");
    $prod = new Products();
    $allproduct = $prod->displayProductsByCategory($_GET['cat_id'] ?? '');
    $cat = new Categories();
    $allcat = $cat->viewAllCategories();

    if (isset($_POST['update'])) {
        $proId = $_POST['proId'];
        $proName = $_POST['proName'];
        $proDesc = $_POST['proDesc'];
        $proPrice = $_POST['proPrice'];
        $catId = $_POST['catId'];
        $proImage = $_POST['img'];
        $stock = $_POST['stockSelect'];
        if ($_FILES['proImage']['size'] != 0) {
            $file_name = $_FILES['proImage'];
            move_uploaded_file($file_name['tmp_name'], "../upload/images/" . $file_name['name']);
            $upd = new Products($proId, $proName, $proDesc, $proPrice, $file_name['name'], $stock,0);
            $updateProduct = $upd->updateProduct($catId);
        } else {
            $upd = new Products($proId, $proName, $proDesc, $proPrice, $proImage, $stock,0);
            $updateProduct = $upd->updateProduct($catId);
        }
    }
    if (isset($_POST['delete'])) {
        $proId = $_POST['proId'];
        $delproduct = new Products();
        $delete = $delproduct->deleteProduct($proId);
    }
} else {
    echo "<script>
        window.location = '../login.php';
        </script>";
}

?>
<div class="main-panel">
    <?php
    if ($allproduct != false) {

    ?>
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">
                    Products
                </h4>
                <h4 class="page-title ml-auto">
                    <a class="btn btn-success" href="addproduct.php">Add Product</a>
                </h4>
            </div>
            <div class="table-responsive-lg">
                <table class="table">
                    <caption>List of Products</caption>
                    <thead>
                        <tr>
                            <th scope="col" class="text-light">Image</th>
                            <th scope="col" class="text-light">Product Name</th>
                            <th scope="col" class="text-light">Price</th>
                            <th scope="col" class="text-light">Category</th>
                            <th scope="col" class="text-light">Stock</th>
                            <th scope="col" class="text-light">Update</th>
                            <th scope="col" class="text-light">Delete</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            foreach ($allproduct as $product) {
                            ?>
                        <tr>
                            <td>
                                <div class=" d-flex justify-content-between align-items-center ">

                                    <img class="img-fluid " style="width: 100px; height:100px;"
                                        src="../uploads/productsImages/<?= $product['pImage'] ?>" class="img-fluid rounded-3"
                                        alt="Image Not Found" data-toggle="modal"
                                        data-target="#myModal<?= $product['id'] + 10 ?> ">

                                    <!-- Product Description Modal here-->
                                    <div class="modal" id="myModal<?= $product['id'] + 10 ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Product Description</h4>
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body">

                                                    <textarea class="text-light form-control" name="proDesc" type="text"
                                                        rows="10"><?= $product['pDesc'] ?></textarea>

                                                    <br>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h5 class="text-light"><?= $product['pName'] ?></h5>
                            </td>

                            <td class="text-light">
                                <?= $product['pPrice'] ?> PKR
                            </td>
                           
                            <td class="text-light">
                                <?= $product['cat_Name'] ?>
                            </td>
                            <td class="text-light">
                                <?= $product['inStock'] ?>

                            </td>
                            <td class="text-light">
                                <!-- Button to Open the Modal here-->
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#myModal<?= $product['pId'] ?>">
                                    Update
                                </button>
                                <!-- The Modal here-->
                                <div class="modal" id="myModal<?= $product['pId'] ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Update Product</h4>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <!-- <img src="uploads/category/" alt=""> -->
                                                <form action="" method="POST" enctype="multipart/form-data">
                                                    <img class=" img img-fluid" style="height:200px;width:100%"
                                                        src="../uploads/productsImages/<?= $product['pImage'] ?>" alt="hello">
                                                    <h4 class="pt-2 mt-2">Title</h4>
                                                    <input type="text" name="proName" id=""
                                                        value="<?= $product['pName'] ?>"
                                                        class=" text-light form-control">
                                                    <br>
                                                    <h4 class="pt-2 mt-2">Description</h4>

                                                    <textarea class=" form-control" name="proDesc" type="text"
                                                        rows="3"><?= $product['pDesc'] ?></textarea>

                                                    <br>
                                                    <h4 class="pt-2 mt-2">Price</h4>
                                                    <input type="text" name="proPrice" id=""
                                                        value="<?= $product['pPrice'] ?>" class="form-control">
                                                    <br>
                                                    <h4 class="pt-2 mt-2">Discount Price</h4>
                                                 
                                                    <h4 class="pt-2 mt-2">Stock</h4>
                                                    <select name="stockSelect" id="">
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                    <br>
                                                    <h4 class="pt-2 mt-2">Category</h4>

                                                    <select class="select" name="catId">
                                                        <?php
                                                                foreach ($allcat as $eachCategory) {
                                                                ?>
                                                        <?php
                                                                    if ($eachCategory['cat_id'] == $product['cat_id']) {
                                                                    ?>
                                                        <option value="<?= $eachCategory['cat_id'] ?>" selected>
                                                            <?= $eachCategory['cat_Name'] ?></option>
                                                        <?php
                                                                    } else {
                                                                    ?>
                                                        <option value="<?= $eachCategory['cat_id'] ?>">
                                                            <?= $eachCategory['cat_Name'] ?></option>
                                                        <?php
                                                                    }
                                                                }
                                                                ?>

                                                    </select>
                                                    <br>
                                                    <h4 class="pt-2 mt-2">Update Picture</h4>
                                                    <input type="file" name="proImage" value="" class="form-control">
                                                    <input type="hidden" name="proId" value="<?= $product['pId'] ?>">
                                                    <input type="hidden" name="img" value="<?= $product['pImage'] ?>">
                                                    <br>
                                                    <input type="submit" name="update" value="Update"
                                                        class="btn btn-primary" id="">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <form action="" method="POST">
                                    <input type="hidden" name="proId" value="<?= $product['pId'] ?>">
                                    <input type="submit" name="delete" class="btn btn-danger" value="Delete" id="">
                                </form>
                            </td>
                        </tr>
                        <?php

                            }
                            ?>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <?php
    } else {
    ?>
    <div class="row mt-5">
        <div class="col-3"></div>
        <div class="col-9 mb-5">
            <h3>No Products with this category.</h3>
        </div>
        <div class="col-5 mt-5"></div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="continue__btn">
                <a href="viewcategories.php">
                    <- back</a>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <?php
    require_once("includes/footer.php");
    ?>