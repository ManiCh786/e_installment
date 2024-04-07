<?php

session_start();
// Count all Userrs
if (isset($_SESSION['Logged_in']) && $_SESSION['user_type'] == 'seller') {
	require_once('../classes/user.class.php');
	require_once('../classes/installmentplans.class.php');
	$users = new User();
	$newUsers = $users->newUsers();
	$totalUsers = $users->totalUsers();
	$totalSellers = $users->totalSellers();
	$userDetails = $users->getLoggedInUserInformation($_SESSION['User_id']);

	$installmentPlan = new InstallmentPlans();
	$total = $installmentPlan->totalPlans();
} else {
	echo "<script>
        window.location = '../login.php';
          </script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>E-Installment | Admin Dashboard</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="assets/img/icon.ico" type="image/x-icon" />
	<!-- Fonts and icons -->
	<script src="repeater.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {
				"families": ["Open+Sans:300,400,600,700"]
			},
			custom: {
				"families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"],
				urls: ['../assets/css/fonts.css']
			},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/azzara.min.css">
	<!-- for bootstrap Modals -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

</head>

<body>
	<div class="wrapper">
		<!--
			Tip 1: You can change the background color of the main header using: data-background-color="blue | purple | light-blue | green | orange | red"
		-->
		<div class="main-header" data-background-color="red">
			<!-- Logo Header -->
			<div class="logo-header">

				<a href="../logout.php" class="logo">
					<h3 class="text-dark font-weight-bold navbar-brand">
						LOGOUT
					</h3>
					<!-- <img src="assets/img/logoazzarad.svg" alt="navbar brand" class="navbar-brand"> -->
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="fa fa-bars"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
				<div class="navbar-minimize">
					<button class="btn btn-minimize btn-rounded">
						<i class="fa fa-bars"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg">

				<div class="container-fluid">
					<div class="collapse" id="search-nav">
						<form class="navbar-left navbar-form nav-search mr-md-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<button type="submit" name="btnSearch" class="btn btn-search pr-1">
										<i class="fa fa-search search-icon"></i>
									</button>
								</div>
								<input type="text" name="searchQuery" placeholder="Search ..." class="form-control">
							</div>
						</form>
					</div>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item toggle-nav-search hidden-caret">
							<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
								<i class="fa fa-search"></i>
							</a>
						</li>
						<?php
						foreach ($userDetails as $eachDetail) {
						?>
							<li class="nav-item dropdown hidden-caret">


								<ul class="dropdown-menu dropdown-user animated fadeIn">
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="../uploads/usersSignupPics/<?= $eachDetail['profilepic'] ?>" alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4><?= $eachDetail['fName'] ?> <?= $eachDetail['lName'] ?></h4>
												<p class="text-muted"><?= $eachDetail['email'] ?></p><a href="myprofile.php" class="btn btn-rounded btn-danger btn-sm">View Profile</a>
											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>

										<a class="dropdown-item" href="../logout.php">Logout</a>
									</li>
								</ul>

							</li>
						<?php
						}
						?>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<div class="sidebar">

			<div class="sidebar-background"></div>
			<div class="sidebar-wrapper scrollbar-inner">
				<div class="sidebar-content">
					<?php
					foreach ($userDetails as $eachDetail) {
					?>
						<div class="user">

							<div class="info">
								<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
									<span>
										<?= $eachDetail['fName'] ?> <?= $eachDetail['lName'] ?>
										<span class="user-level"><?= $eachDetail['accountType'] ?></span>
										<span class="caret"></span>
									</span>
								</a>
								<div class="clearfix"></div>

								<div class="collapse in" id="collapseExample">
									<ul class="nav">
										<li>
											<a href="myprofile.php">
												<span class="link-collapse">My Profile</span>
											</a>
										</li>

									</ul>
								</div>
							</div>
						</div>
					<?php
					}
					?>
					<ul class="nav">
						<!-- <li class="nav-item active"> -->
						<li class="nav-item ">
							<a href="index.php">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
								<!-- <span class="badge badge-count">5</span> -->
							</a>
						</li>

					
						<li class="nav-item">
							
							<a href="addproduct.php ">
								<i class="fas fa-user"></i>
								<p>Add Product</p>
								
							</a>
						</li>
						<li class="nav-item">
							
							<a href="viewproducts.php">
								<i class="fas fa-user"></i>
								<p>View Products</p>
								
							</a>
						</li>
						<li class="nav-item">
							<?php
							$check = 'rider';
							?>
							<a href="usersmanagement.php?check=<?= $check ?>">
								<i class="fas fa-user"></i>
								<p>Rider</p>
								
							</a>
						</li>
						<li class="nav-item">

							<a href="viewinstallmentplans.php">
								<i class="fas fa-user"></i>
								<p>Installment Plans</p>

								
							</a>
						</li>
						<li class="nav-item">

							<a href="viewcategories.php">
								<i class="fas fa-user"></i>
								<p>Categories</p>

								
							</a>
						</li>
						<li class="nav-item">

							<a href="orders.php">
								<i class="fas fa-user"></i>
								<p>Orders</p>

								<span class="badge badge-count"></span>

							</a>
						</li>
						<li class="nav-item">

							<a href="addInstallment.php">
								<i class="fas fa-user"></i>
								<p>Add Installment</p>

								<span class="badge badge-count"></span>

							</a>
						</li>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->