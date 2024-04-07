<?php
require_once("includes/header.php");



if (isset($_SESSION['Logged_in']) && $_SESSION['user_type']=='seller') {
    require_once("../classes/categories.class.php");
    require_once("../classes/products.class.php");

    $cat = new Categories();
    $allcat = $cat->viewAllCategories();
    if (isset($_POST['addproduct'])) {
        // $proId = $_POST['proId'];
        $proName = $_POST['pName'];
        $proDesc = $_POST['pDesc'];
        $proPrice = $_POST['pPrice'];
        $catId = $_POST['catId'];
        $stock = $_POST['stockSelect'];
        $catName = $_POST['cat_Name'];
        if ($_FILES['pImage']['size'] != 0) {
            $file_name = $_FILES['pImage'];

            move_uploaded_file($file_name['tmp_name'], "../uploads/productsImages/" . $file_name['name']);
            $addProduct = new Products(0, $proName, $proDesc, $proPrice, $file_name['name'], $stock,0);
            $add = $addProduct->addProduct($catId);
        }
    }

} else {
    echo "<script>
        window.location = '../vd.php';
        </script>";
}

?>

<div class="main-panel mt-4">
    <div class="content">
        <div class="page-inner">
            <div class="page-header ml-2">
                <h4 class="page-title">
                    Add Product
                </h4>
            </div>
            <div class="row mb-4 ml-2 mr-2">

                <div class="col-md-6 ml-4">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="text" name="pName" placeholder="Product Name" class="form-control" required />
                        <br>
                        <textarea class="text-light form-control" name="pDesc" type="text" rows="10"
                            placeholder="Product Description" required></textarea>


                        <br><input type="number" name="pPrice" placeholder="Product Price" class="form-control"
                            required />
                        <br>
                       
                        <h4 class="pt-2 mt-2">In Stock</h4>

                        <select name="stockSelect" id="">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                        <br>

                        <h4 class="pt-2 mt-2">Category</h4>
                        <select class="select" name="catId">
                            <?php
                            foreach ($allcat as $eachCategory) {
                            ?>
                            <option value="<?= $eachCategory['cat_id'] ?>"><?= $eachCategory['cat_Name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <br>
                        <input type="hidden" name="cat_Name" value="<?= $eachCategory['cat_Name'] ?>">

                        <br>
                        <h4 class="pt-2 mt-2">Choose Image</h4>

                        <input type="file" name="pImage" class="form-control" required />
                        <br>
                        <input type="submit" class="btn btn-block bg-success" name="addproduct" value="Add Product"
                            class="btn btn-primary">
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-6"></div>
    <?php
    require_once("includes/footer.php");
    ?>