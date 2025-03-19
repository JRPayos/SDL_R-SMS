<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
	
	<!-- Latest compiled and minified CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- Latest compiled JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	
	<link href="../css/style.css" rel="stylesheet">
	
	<!--FONT-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Anton&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
	
	
</head>
<body>
<div>
	<header class="header-login">
		<div class="container-fluid">
			<div class="row justify-content-between">
				<div class="col-lg-12 col-12">
					<a class="header-login-text d-flex justify-content-center align-items-center me-auto" href="login.php">
						<img src="../images/logo.png" class="img-fluid" style="height: 100px" alt="Logo.png">
                    	<span><h1>Retail-Stock Managament System</h1></span>
                    </a>
                </div>
			</div>
        </div>
    </header>
	
    <div class="shadow-sm container-fluid">
		<div class="row">
			<div class="col-6 login-image justify-content-center pt-4">
				<img src="../images/inv1.jpg" class="img-thumbnail mb-4" alt="image1">
				<img src="../images/inv2.jpg" class="img-thumbnail mb-4" alt="image2">
				<img src="../images/inv3.jpg" class="img-thumbnail mb-4" alt="image3">
			</div>
			<div class="col login-container justify-content-center">
                <h2 class="text-center pd-4">Admin Login</h2>
                <form method="post" action="../includes/login_inc.php" >
                    <div class="form-floating p-0" >
                        <input type="text" name="aduser" id="floatAduser" class="form-control login-input" placeholder="Admin Name" >
                        <label for="floatAduser" class="login-input-label">Admin Name</label>
                    </div>
                    <div class="form-floating p-0">
                        <input type="password" name="adpass" id="floatAdpass" class="form-control login-input" placeholder="Password">
                        <label for="floatAdpass">Password</label>
                    </div>
            	    <button type="submit" name="submit" class="btn login-btn oswald-regular">LOGIN</button>
                </form>
                <?php
                    if (isset($_GET["error"])) {
                        if ($_GET["error"] == "emptyinput") {
                        echo "<p class='text-center text-danger mt-2'>Fill in all fields! </p>";
                        }
                        else if ($_GET["error"] == "wronglogin") {
                        echo "<p class='text-center text-warning mt-2'>Incorrect Login information! </p>";
                        }
                    }
		        ?>
			</div>
		</div>
    </div>
	
<?php
	include_once 'footer.php';
?>