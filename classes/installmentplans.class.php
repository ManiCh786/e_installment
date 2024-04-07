<?php
require_once('database.class.php');
class InstallmentPlans extends Database
{

    private $installmentId;
    private $title;
    private $downpayment;
    private $installmentpermonth;
    private $duration;
    
    public function __construct($_installmentId=0,$_title='',$_downpayment=0,$_installmentpermonth=0,$_duration=0){
        parent::__construct();
        $this->installmentId = $_installmentId;
        $this->title = $_title;
        $this->downpayment = $_downpayment;
        $this->installmentpermonth = $_installmentpermonth;
        $this->duration =$_duration;
    }
    public function getInstallmentPlans(){
        $this->Query('SELECT * FROM `installmentplans` WHERE :flag');
        $this->Bind(':flag', 1);
        if ($this->Total()) {
            return $this->All();
        } else {
            return 0;
        }
    }
    public function addNewPlan(){
        $this->Query('SELECT * FROM `installmentplans` WHERE installmentplans.title = :title');
        $this->Bind(':title', $this->title);
        if ($this->Total()) {
            echo '<script>alert("This Plan Already Exits !")</script>';
            
        } else {
            $this->Query('INSERT INTO `installmentplans`(`title`, `downpayment`, `installmentpermonth`, `duration`) VALUES (:title,:downpayment,:installmentpermonth,:duration)');
            $this->Bind(':title', $this->title);
            $this->Bind(':downpayment', $this->downpayment);
            $this->Bind(':installmentpermonth', $this->installmentpermonth);
            $this->Bind(':duration', $this->duration);
            if ($this->Run()) {
                echo ('<Script>alert("PLan Added Succesfully !")</Script>');
                

            } else {
                echo ('<Script>alert("Error ! Try Again Later")</Script>');
            }


            
        }
    }
    public function deleteInstallment(){
        $this->Query('DELETE FROM `installmentplans` WHERE installmentplans.installmentId = :id');
        $this->Bind(':id', $this->installmentId);
        if ($this->Run()) {
            echo '<script>alert("Deleted Succesfully !")</script>';
            
        } else {
                echo ('<Script>alert("Error ! Try Again Later")</Script>');
        }
    }
    public function updateInstallment(){
        $this->Query('UPDATE `installmentplans` SET `title`=:title,`downpayment`=:downpayment,`installmentpermonth`=:installmentpermonth,`duration`=:duration WHERE installmentplans.installmentId = :id');
        $this->Bind(':id', $this->installmentId);
        $this->Bind(':title', $this->title);
        $this->Bind(':downpayment', $this->downpayment);
        $this->Bind(':installmentpermonth', $this->installmentpermonth);
        $this->Bind(':duration', $this->duration);
        if ($this->Run()) {
            echo '<script>alert("Updated Succesfully !")</script>';
            
        } else {
                echo ('<Script>alert("Error ! Try Again Later")</Script>');
        }
    }
    public function totalPlans()
    {
        $this->Query("SELECT COUNT(installmentId) AS NumberOfPlans FROM installmentplans WHERE   :flag ");
        $this->Bind(':flag', 1);
        return $this->All();    
    }

}
?>