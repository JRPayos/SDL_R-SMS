<?php
session_start();

//checks if user is logged in
if(isset($_SESSION['adminName'])) {
    
}
//if not, back to login page
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
	
	<!-- Latest compiled and minified CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link href="../css/style.css" rel="stylesheet">
	
	<!--ICONS-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

	<!--FONT-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Anton&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
	<style>
	
	#sidebar {
      width: 250px;
      transition: width 0.3s;
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      overflow-y: auto;
      z-index: 1000;
    }
    #sidebar.collapsed {
      width: 80px;
    }
    #sidebar .nav-link {
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    #sidebar.collapsed .nav-link span {
      display: none;
    }
    #sidebar.collapsed .nav-link i {
      margin-right: 0;
    }
    .main-content {
      margin-left: 250px;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    .main-content.collapsed {
      margin-left: 80px;
    }
    .content {
      flex-grow: 1;
      padding: 20px;
    }
    .profile-card {
      display: flex;
      align-items: center;
      text-decoration: none;
      color: inherit;
	  background-color: #B7DCFF;
	  border-radius: 10px;
    }
    .profile-img {
      height: 25px;
      width: 25px;
      border-radius: 50%;
      margin-right: 10px;
    }
  </style>
	
</head>
<body>
	<nav class="navbar navbar-expand-lg header-login">
		<div class="container-fluid">
			<a class="navbar-brand d-flex align-items-center" href="#">
				<img src="../images/logo.png" alt="Brand Logo" style="height: 45px;	width: 45px; margin-right: 10px;">
				<span><h2 class="brand-name">Retail-Stock Management System</h2></span>
			</a>
			<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item d-flex align-items-center">
						<a href="profile.php" class="nav-link profile-card">
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