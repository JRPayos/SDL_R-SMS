<?php
session_start();

if(isset($_SESSION['adminName'])) {
    
}
else {
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>R-SMS</title>
	
	<!-- Latest compiled and minified CSS BOOTSTRAP-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link href="../css/style.css" rel="stylesheet">
	
	<!--ICONS-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

	<!--FONT-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Anton&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
	<style>
	.profile-card {
      display: flex;
      align-items: center;
      text-decoration: none;
      color: inherit;
	  background-color: #B7DCFF;
	  border-radius: 10px;
    }
    .profile-img {
      height: 20px;
      width: 20px;
      border-radius: 50%;
      margin-right: 10px;
    }
  </style>
</head>
<body>
	<nav class="navbar navbar-expand-lg header-login">
		<div class="container-fluid">
			<a class="navbar-brand d-flex align-items-center" href="../pages/home.php">
				<img src="../images/logo.png" alt="Brand Logo" style="height: 45px;	width: 45px; margin-right: 10px;">
				<span><h2 class="brand-name">Retail-Stock Management System</h2></span>
			</a>
			<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item d-flex align-items-center justify-content-center">
						<a href="../pages/profile.php" class="nav-link profile-card">
							<img src="../images/placeholder.jpg" alt="User Profile" class="profile-img">
							<span class="pe-2">
						<?php
							require_once '../includes/db_inc.php';
							require_once '../includes/functions_inc.php';

							if (isset($_SESSION["adminName"])){
								echo $_SESSION["adminName"]. "</span>";
							}
						?>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

<div class="wrapper">
    <div class="container-fluid manager-container">
		<div class="row">
			<div class="col-2 bg-dark align-items-center" style="padding:0;">
					<ul class="nav nav-pills nav-fill flex-column">
						<li class="nav-item">
							<a href="../pages/dashboard.php" class="nav-link sidebar-buttons rounded-0 py-3" >Dashboard</a>
						</li>
						<li class="nav-item">
							<a href="../pages/product_inv.php" class="nav-link sidebar-buttons rounded-0 py-3">Product Stock</a>
						</li>
						<li class="nav-item ">
							<a href="../pages/sales.php" class="nav-link sidebar-buttons rounded-0 py-3">Sales Record</a>
						</li>
						<li class="nav-item">
							<a href="../pages/supplier_master.php" class="nav-link sidebar-buttons rounded-0 py-3" >Supplier List</a>
						</li>
						<li class="nav-item">
							<a href="../pages/supplier_deliveries.php" class="nav-link sidebar-buttons rounded-0 py-3" >Supplier Deliveries</a>
						</li>
						<li class="nav-item">
							<a href="../pages/account_manager.php" class="nav-link sidebar-buttons rounded-0 py-3" >Account Manager</a>
						</li>
						<li class="nav-item">
							<a href="../pages/profile.php" class="nav-link sidebar-buttons rounded-0 py-3">Profile</a>
						</li>
						<li class="nav-item">
							<a href="../pages/home.php" class="nav-link sidebar-buttons rounded-0 py-3">Home</a>
						</li>
						<li class="nav-item">
							<a href="../includes/logout_inc.php" class="nav-link sidebar-buttons rounded-0 py-3">Logout</a>
						</li>
					</ul>
					<div class="d-flex justify-content-center">
						<p id=datetime style="color:white;"></p>
					</div>
					<script>
							function getCurrentDateTime() {
								// Get current local time
								var now = new Date();

								// Format date and time with options
								var formattedDateTime = now.toLocaleString('en-US', {
									month: 'short',
									day: '2-digit',
									year: 'numeric',
									hour: 'numeric',
									minute: '2-digit',
									hour12: true
								});

								// Display the formatted date and time
								document.getElementById('datetime').innerText = formattedDateTime;
							}

							window.onload = getCurrentDateTime;
					</script>					
            </div>