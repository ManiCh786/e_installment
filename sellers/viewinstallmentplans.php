<?php
require_once("includes/header.php");
if (isset($_SESSION['Logged_in']) && $_SESSION['user_type'] == 'seller') {
    require_once("../classes/installmentplans.class.php");
    $installmentPlan = new InstallmentPlans();
    $installmentPlans = $installmentPlan->getInstallmentPlans();
 
 
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
  
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Installment Id</th>
                        <th scope="col">Title</th>
                        <th scope="col">Down Payment (%)</th>
                        <th scope="col">Installment Per Month  (%)</th>
                        <th scope="col">Duration</th>
                       
                        
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
                          
                       
                            
                        </tr>
                    </tbody>
                <?php
               }
                ?>
            </table>
        </div>
    </div>
</div>
