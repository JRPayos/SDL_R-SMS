<?php
	include_once 'header.php';
?>

    <div class="container-fluid home-container">
		<div class="row">
			<div class="col">
				<a href="../pages/dashboard.php" class="text-decoration-none">
					<img src="../images/dashboard.png" class="img-thumbnail mb-4" alt="Dashboard">
					<span><h4>Dashboard</h4></span>
				</a>
			</div>
			<div class="col home-text">
				<a href="../pages/product_inv.php" class="text-decoration-none">
					<img src="../images/products.png" class="img-thumbnail mb-4" alt="Products">
					<h4>Product Stock</h4>
				</a>
			</div>
			<div class="col home-text">
				<a href="../pages/sales.php" class="text-decoration-none">
					<img src="../images/orders.png" class="img-thumbnail mb-4" alt="Sales">
					<h4>Sales Record</h4>
				</a>
			</div>
		</div>
		<div class="row">
			<div class="col ">
				<a href="../pages/account_manager.php" class="text-decoration-none">
					<img src="../images/account.png" class="img-thumbnail mb-4" alt="Account Manager">
					<span><h4>Account Manager</h4></span>
				</a>
			</div>
			<div class="col">
				<a href="../pages/profile.php" class="text-decoration-none">
					<img src="../images/profile.png" class="img-thumbnail mb-4" alt="Profile">
					<h4>Profile</h4>
				</a>
			</div>
			<div class="col">
				<a href="../includes/logout_inc.php" class="text-decoration-none">
					<img src="../images/logout.png" class="img-thumbnail mb-4" alt="Logout">
					<h4>Logout</h4>
				</a>
			</div>
		</div>
    </div>
<?php
    include_once 'footer.php';
?>

