<?php
    require_once('database.class.php');
    class Categories extends Database{
        private $id;
        private $catName;
        
        public function __construct($_id=0,$_catName=''){
            parent::__construct();
            $this->id= $_id;
            $this->catName = $_catName;

        }
    public function viewAllCategories(){
        $this->Query("SELECT * FROM categories WHERE :flag");
        $this->Bind(':flag',1);
        return $this->All();
    }public function AddCategory(){
        $this->Query("INSERT INTO `categories`(`cat_Name`) VALUES (:category)");
        $this->Bind(':category',$this->catName);
        if($this->Run()){
            echo "<script type='text/javascript'>alert('Category Inserted Successfully ')</script>";
        }
    }
    public function updateCategory(){
        $this->Query('UPDATE `categories` SET `cat_Name`= :catName WHERE cat_id = :catId');
        $this->Bind(':catId',$this->id);
        $this->Bind(':catName',$this->catName);
        if($this->Run()){
            echo "<script type='text/javascript'>alert('Category Updated Succefully ')</script>";
        }

    }
    public function deleteCategory(){
        $this->Query('DELETE FROM `categories` WHERE cat_id =:catId');
        $this->Bind(':catId',$this->id);
        if($this->Run()){
            
            echo "<script type='text/javascript'>alert('Category Deleted Succefully ')</script>";
            
              
        }else{
            echo "<script type='text/javascript'>alert('Error occured ! Try again later')</script>";

        }
    }
    public function totalCat(){
        $this->Query("SELECT COUNT(cat_id) AS NumberOfCategories FROM categories WHERE   :flag ");
        $this->Bind(':flag',1);
        return $this->All();
    }
   

    }

?>