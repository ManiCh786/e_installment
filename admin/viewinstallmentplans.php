<?php
require_once("includes/header.php");
if (isset($_SESSION['Logged_in']) && $_SESSION['user_type'] == 'admin') {
    require_once("../classes/installmentplans.class.php");
    $installmentPlan = new InstallmentPlans();
    $installmentPlans = $installmentPlan->getInstallmentPlans();
    if(isset($_POST['addNewInstallment'])){
        $title =$_POST['installmentTitle'];
        $downPayment =$_POST['downPayment'];
        $installmentpermonth =$_POST['installmentpermonth'];
        $duration =$_POST['duration'];
        $installment = new InstallmentPlans(0,$title,$downPayment,$installmentpermonth,$duration);
        $addInstallment = $installment->addNewPlan();
        echo "<script>
        window.location = 'viewinstallmentplans.php';
        </script>";
    }
    if (isset($_POST['deleteInstallment'])) {
        $id = $_POST['installmentId'];
        $installment = new InstallmentPlans($id);
        $delete = $installment->deleteInstallment();
        echo "<script>
    window.location = 'viewinstallmentplans.php';
    </script>";
    }
    if (isset($_POST['updateInstallment'])) {
        $id = $_POST['id'];
        $title =$_POST['installmentTitle'];
        $downPayment =$_POST['downPayment'];
        $installmentpermonth =$_POST['installmentpermonth'];
        $duration =$_POST['duration'];
        $installment = new InstallmentPlans($id,$title,$downPayment,$installmentpermonth,$duration);
        $delete = $installment->updateInstallment();
        echo "<script>
    window.location = 'viewinstallmentplans.php';
    </script>";
    }
} else {
    echo "<script>
    window.location = '../logout.php';
    </script>";
}

?>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">
                    Installment Plans
                </h4>

            </div>
            <!-- Button trigger modal -->
<a href="#exampleModalLong" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong" >Add New Plan </a>
<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add New Installment Plans</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
        <h4 class="pt-2">Title  </h4>
        <input type="text" name="installmentTitle" value="" class="form-control" required autofocus />
        <br> 
        <h4 class="pt-2">Down Payment (%) </h4>
        <input type="number" name="downPayment" value="" class="form-control" required autofocus />
        <br> 
        <h4 class="pt-2">Installment Per Month  (%) </h4>
        <input type="number" name="installmentpermonth" value="" class="form-control" required autofocus />
        <br> 
        <h4 class="pt-2">Duration  </h4>
        <input type="number" name="duration" value="" class="form-control" required autofocus />
        <br> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" name="addNewInstallment" class="btn btn-primary">Save </button>
      </div>
      </form>

    </div>
  </div>
</div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Installment Id</th>
                        <th scope="col">Title</th>
                        <th scope="col">Down Payment (%)</th>
                        <th scope="col">Installment Per Month  (%)</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Delete</th>
                        <th scope="col">Update</th>
                        
                    </tr>
                </thead>
               <?php
            
               foreach($installmentPlans as $eachValue){
               ?>
                    <tbody>

                        <tr>


                            <td>
                                <h5><?=$eachValue['installmentId']?></h5>
                            </td>

                            <td>
                                <h5><?=$eachValue['title']?></h5>

                            </td>
                            <td>
                                <h5><?=$eachValue['downpayment']?> (%)</h5>
                            </td>
                            <td>
                                <h5><?=$eachValue['installmentpermonth']?> (%)</h5>
                            </td>

                            <td>
                                <h5><?=$eachValue['duration']?></h5>
                            </td>
                            <td>
                            <form action="" method="POST">
                                    <input type="hidden" name="installmentId" value="<?= $eachValue['installmentId'] ?>">
                                    <input type="submit" name="deleteInstallment" class="btn btn-danger" value="Delete" id="">
                                </form>
                            </td>
                            <td>
                            <a href="#exampleModalLong" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong<?= $eachValue['installmentId'] ?>" >Update </a>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalLong<?= $eachValue['installmentId'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Update Installment Plans</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post">
                                        <input type="hidden" name="id" value="<?=$eachValue['installmentId']?>">
                                    <h4 class="pt-2">Title  </h4>
                                    <input type="text" name="installmentTitle" value="<?=$eachValue['title']?>" placeholder="<?=$eachValue['title']?>" class="form-control" required autofocus />
                                    <br> 
                                    <h4 class="pt-2">Down Payment (%) </h4>
                                    <input type="number" name="downPayment" value="<?=$eachValue['downpayment']?>" class="form-control" required autofocus />
                                    <br> 
                                    <h4 class="pt-2">Installment Per Month  (%) </h4>
                                    <input type="number" name="installmentpermonth" value="<?=$eachValue['installmentpermonth']?>" class="form-control" required autofocus />
                                    <br> 
                                    <h4 class="pt-2">Duration  </h4>
                                    <input type="number" name="duration" value="<?=$eachValue['duration']?>" class="form-control" required autofocus />
                                    <br> 
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="submit" name="updateInstallment" class="btn btn-success">Update </button>
                                </div>
                                </form>

                                </div>
                            </div>
                            </div>

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
