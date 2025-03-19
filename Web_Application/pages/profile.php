<?php
	include_once 'header_test.php';
?>
    <div class="col align-content-top bg-light">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.php" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
        </nav>
		<!--PROFILE DISPLAY-->
        <div class="card mb-4">
			<div class="card-header d-flex justify-content-between align-items-center">
				<h2 class="mb-0">User Profile</h2>
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
					<i class="bi bi-cloud-arrow-up-fill"></i> Change Profile Picture
				</button>
			</div>
			<div class="card-body">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<span>Profile</span>
					</div>
					<div class="panel-body">
						<img src="../images/placeholder.jpg" alt="Profile Image" style="width:90px;">
						<form>
						<!--PROFILE DETAILS from DB-->
						<?php	
							require_once '../includes/db_inc.php';
							require_once '../includes/functions_inc.php';
							$admin_id = $_SESSION['adminId']; 
							$sql = "SELECT admin_fname, admin_lname, admin_email, admin_phonenum, admin_username FROM `admin` WHERE admin_id='$admin_id'";
							$result = $conn->query($sql);
							
							if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {
									echo "<label for='profileName' class='form-label'>Name</label>
											<input type='text' id='profileName' class='form-control' value= '".$row["admin_fname"]." ".$row["admin_lname"]."' readonly>
											<label for='fullName' class='form-label'>Username</label>
											<input type='text' id='fullName' class='form-control' value=".$row["admin_username"]." readonly>
											<label for='email' class='form-label'>Email</label>
											<input type='email' id='email' class='form-control' value=".$row["admin_email"]." readonly>
											<label for='phone' class='form-label'>Phone Number</label>
											<input type='tel' id='phone' class='form-control' value= '0".$row["admin_phonenum"]."' readonly>";
								}
							echo "</form>";
							} else {
							echo "<h3> 0 results </h3>";
							}
							$conn->close();
						?>
					</div>
				</div>
			</div>
		</div>

		<!--MODAL-->
		<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="staticBackdropLabel">Upload new Profile picture</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form action="../includes/register_inc.php" method="post" autocomplete="off">
							<div class="mb-3">
								<input class="form-control" type="file" id="formFile">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
								<button type="submit" class="btn btn-primary" name="submit">Upload</button>
					  		</div>
						</form>
					</div>
				</div>
			</div>
		</div>
<?php
	include_once 'footer.php';
?>
