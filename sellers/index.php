<?php
include_once("includes/header.php");
if (isset($_SESSION['Logged_in']) && $_SESSION['user_type'] == 'seller') {
	include_once('../classes/user.class.php');
	include_once('../classes/installmentplans.class.php');

	$users = new User();
	// $newUsers = $users->newUsers();
	// $totalUsers = $users->totalUsers();
	// $totalSellers = $users->totalSellers();
	// $installmentPlan = new InstallmentPlans();
	// $total = $installmentPlan->totalPlans();
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
				<h4 class="page-title">Dashboard</h4>

			</div>
			<div class="row">
			<div class="col-sm-6 col-md-3">
					<div class="card card-stats card-round">
						<div class="card-body">
							<?php
							$check = 'seller';

							?>
							<div class="row align-items-center">
								<div class="col-icon">
									<div class="icon-big text-center icon-info bubble-shadow-small">
										<a href="viewinstallmentplans.php"> <i class="fas fa-users"></i></a>
									</div>
								</div>
								<div class="col col-stats ml-3 ml-sm-0">
									<?php


									foreach ($total as $eachSeller) {
									?>

										<div class="numbers">
											<a href="viewinstallmentplans.php">
												<p class="card-category">Installment Plans</p>
											</a>
											<h4 class="card-title"><?= $eachSeller['NumberOfPlans'] ?></h4>
										</div>
									<?php
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div> 

			
			</div>

		</div>

	</div>


</div>
<?php
require_once("includes/footer.php");
?>