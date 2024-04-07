<?php
require_once('database.class.php');
class Products extends Database
{
    private $id;
    private $pName;
    private $pDesc;
    private $pPrice;
    private $pImage;
    private $stock;
    private $sellerId;

    public function __construct($_id = 0, $_pName = '', $_pDesc = '', $_pPrice = '', $_pImage = '', $_stock = '',$_sellerId=0)
    {
        parent::__construct();
        $this->id = $_id;
        $this->pName = $_pName;
        $this->pDesc = $_pDesc;
        $this->pPrice = $_pPrice;
        $this->pImage = $_pImage;
        $this->stock = $_stock;
        $this->sellerId = $_sellerId;

    }
    

    
    public function displayProductsByCategory($catId,$filter,$searchQry)
    {
     
        if ($catId != 0) {
            $this->Query("SELECT * FROM products_categories,products,categories,users WHERE products_categories.p_id = products.pId AND categories.cat_id = products_categories.cat_id AND products_categories.cat_id =:catId AND users.userId = products.sellerId AND products.inStock =:stock ");
            $this->Bind(':stock','yes');
            $this->Bind(':catId', $catId);
            return $this->All();
     
        }
     
        if ($filter != "") {
     
            if ($filter=="priceDSC") {
                $this->Query("SELECT * FROM products_categories,products,categories,users WHERE products_categories.p_id = products.pId AND categories.cat_id = products_categories.cat_id AND products.inStock =:stock AND users.userId = products.sellerId ORDER BY products.pPrice DESC");
                $this->Bind(':stock','yes');
                return $this->All();
            }

            if ($filter == "priceASC") {

                $this->Query("SELECT * FROM products_categories,products,categories,users WHERE products_categories.p_id = products.pId AND categories.cat_id = products_categories.cat_id AND users.userId = products.sellerId AND  products.inStock =:stock ORDER BY products.pPrice ASC");
                $this->Bind(':stock','yes');
                return $this->All();
            }
            if ($filter == "A-Z") {
                $this->Query("SELECT * FROM products_categories,products,categories,users WHERE products_categories.p_id = products.pId AND categories.cat_id = products_categories.cat_id AND users.userId = products.sellerId AND products.inStock =:stock ORDER BY products.pName ASC");
                $this->Bind(':stock','yes');
                return $this->All();
            }
            if ($filter == "Z-A") {
                $this->Query("SELECT * FROM products_categories,products,categories,users WHERE products_categories.p_id = products.pId AND categories.cat_id = products_categories.cat_id AND users.userId = products.sellerId AND products.inStock =:stock ORDER BY products.pName DESC");
                $this->Bind(':stock','yes');
                return $this->All();
            }
            if ($filter == "new") {
                $this->Query("SELECT * FROM products WHERE created_at >=(NOW() - INTERVAL 1 MONTH) LIMIT 10");
            $this->Bind(':stock','yes');
                return $this->All();
            }
            if ($filter == "slider") {
                $this->Query("SELECT * FROM products_categories,products,categories,users WHERE products_categories.p_id = products.pId AND users.userId = products.sellerId AND categories.cat_id = products_categories.cat_id AND products.pDiscountPrice AND products.inStock =:stock BETWEEN :fPrice AND :sPrice");
                $this->Bind(':fPrice', $this->pPrice);
                // $this->Bind(':sPrice', $this->pDiscountPrice);
            $this->Bind(':stock','yes');
               
                return $this->All();
            }
            if ($filter == "search") {
                
                $this->Query("SELECT * FROM products_categories,products,categories,users WHERE products_categories.p_id = products.pId AND categories.cat_id = products_categories.cat_id AND users.userId = products.sellerId AND products.pName AND products.inStock =:stock LIKE :searchQry ");
                $this->Bind(':searchQry', $searchQry . "%");
            $this->Bind(':stock','yes');
                
                return $this->All();
            }
        } else {
            $this->Query("SELECT * FROM products_categories,products,categories,users WHERE products_categories.p_id = products.pId AND categories.cat_id = products_categories.cat_id AND users.userId = products.sellerId AND products.inStock =:stock");
            $this->Bind(':stock','yes');
            return $this->All();
        }
    }
    public function allProducts ($sellerId){
        $this->Query("SELECT * FROM products_categories,products,categories,users WHERE products_categories.p_id = products.pId AND categories.cat_id = products_categories.cat_id AND users.userId = products.sellerId AND products.sellerId =:sellerId");
        $this->Bind(':sellerId',$sellerId);
        // $this->Run();
        $allProducts = $this->All();
        return $allProducts;
    }
    public function newArrivals (){
        $this->Query("SELECT * FROM products WHERE  products.inStock =:stock AND created_at >=(NOW() - INTERVAL 1 MONTH) LIMIT 6");
        $this->Bind(':stock','yes');

        return $this->All();
     
    }
    public function singleProduct($name, $id)
    {
        // $this->Query("SELECT * FROM products WHERE pName = :pName AND id =:Id Limit 1");
        $this->Query("SELECT * FROM products_categories,products,categories,users WHERE products_categories.p_id = products.pId AND categories.cat_id = products_categories.cat_id AND products.pName = :pName AND users.userId = products.sellerId AND products.pId =:Id Limit 1 ");
        $this->Bind(':pName', $name);
        $this->Bind(':Id', $id);
        return $this->All();
    }
    // Not Done Yet
    public function updateProduct($catId)
    {
        $this->Query('UPDATE `products` SET `pName`=:proName,`pDesc`=:proDesc,`pPrice`=:proPrice,`pImage`=:proImage,`inStock`=:stock WHERE `pId` = :proId');
        $this->Bind(':proId', $this->id);

        $this->Bind(':proName', $this->pName);
        $this->Bind(':proDesc', $this->pDesc);
        $this->Bind(':proPrice', $this->pPrice);
        $this->Bind(':proImage', $this->pImage);
        $this->Bind(':stock', $this->stock);
        if ($this->Run()) {
            $this->Query('UPDATE `products_categories` SET `cat_id`= :catId WHERE products_categories.p_id = :pId');
            $this->Bind(':pId', $this->id);
            $this->Bind(':catId', $catId);
            if ($this->Run()) {

                echo "<script type='text/javascript'>alert('Product Updated Succesfully')</script>";
                echo "<script>
                  window.location = 'viewproducts.php';
                  </script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Error occured ! Try Again Later')</script>";
        }
    }
    public function addProduct($catId)
    {

        $this->Query('SELECT * FROM `products` WHERE products.pName = :pName');
        $this->Bind(':pName', $this->pName);
        if ($this->Total()) {
            echo "<script type='text/javascript'>alert('This Product Name Already Exits !')</script>";
        } else {
            $date = date("Y/m/d");
            $this->Query('INSERT INTO `products` (`pName`, `pDesc`, `pPrice`, `pImage`, `inStock`,`sellerId`,`created_at`,`updated_at`) VALUES (:proName,:proDesc,:proPrice,:proImage,:stock,:sellerId,:created_at,:updated_at )');
            $this->Bind(':proName', $this->pName);
            $this->Bind(':proDesc', $this->pDesc);
            $this->Bind(':proPrice', $this->pPrice);
            $this->Bind(':proImage', $this->pImage);
            $this->Bind(':stock', $this->stock);
            $this->Bind(':sellerId', $_SESSION['User_id']);
            $this->Bind(':created_at', $date);
            $this->Bind(':updated_at', $date);
            if ($this->Run()) {
                $proId = $this->getlastId();
                $this->Query('INSERT INTO `products_categories`(`p_id`,`cat_id`) VALUES (:pId,:catId)');
                $this->Bind(':pId', $proId);
                $this->Bind(':catId', $catId);
                if ($this->Run()) {
                    echo "<script type='text/javascript'>alert('Product Added Succesfully')</script>";
                    echo "<script>
                  window.location = 'addproduct.php';
                  </script>";
                }
            } else {
                echo "<script type='text/javascript'>alert('Error occured ! Try Again Later')</script>";
            }
        }
    }
    public function deleteProduct($pId)
    {
        $this->Query('DELETE FROM `products` WHERE pId =:proId');
        $this->Bind(':proId', $pId);
        if ($this->Run()) {
            echo "<script type='text/javascript'>alert('Product Deleted Succesfully ')</script>";

            echo "<script>
                  window.location = 'viewproducts.php';
                  </script>";
        } else {
            echo "<script type='text/javascript'>alert('Error occured ! Try Again Later')</script>";
        }
    }
    public function totalProducts()
    {
        $this->Query("SELECT COUNT(id) AS NumberOfProducts FROM products WHERE   :flag ");
        $this->Bind(':flag', 1);
        return $this->All();
    }
}