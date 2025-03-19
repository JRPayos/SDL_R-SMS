<?php
	include_once 'header_test.php';
?>
			<div class="col align-content-top bg-light">
			<nav aria-label="breadcrumb">
  				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="home.php" class="text-decoration-none">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">Account Manager</li>
				</ol>
			</nav>
	<div class="card mb-4">
		<div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="mb-0">User Accounts</h2>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
				<i class="bi bi-person-fill-add"></i> Add User
			</button>
        </div>
		<div class="card-body">
				<div class="table-responsive">
			<?php	
				require_once '../includes/db_inc.php';

				$sql = "SELECT admin_id, admin_fname, admin_lname, admin_email, admin_phonenum, admin_username FROM `admin`";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
				echo "<table class='table table-bordered table-striped'>
						<tr>
							<th>#ID</th>
							<th>Name</th>
							<th>Email</th>
							<th>Phone Number</th>
							<th>Username</th>
							<th>Edit</th>
						</tr>";
					// output data of each row
					while($row = $result->fetch_assoc()) {
						echo "<tr class='text-center'>
								<td>".$row["admin_id"]."</td>
								<td>".$row["admin_fname"]." ".$row["admin_lname"]."</td>
								<td>".$row["admin_email"]."</td>
								<td> 0".$row["admin_phonenum"]."</td>
								<td>".$row["admin_username"]."</td>
								<td class='d-flex justify-content-center'>
									
									<button class= 'btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteModal' data-id='".$row['admin_id']." 'data-name='".$row['admin_fname']." ".$row['admin_lname']."'><i class='bi bi-trash3-fill'></i></button>
									</td>
                                </td>
							</tr>";
					} 
				echo "</table>";
				} else {
				echo "<h3> 0 results </h3>";
				}
				$conn->close();
				?>
	</div>
				<!-- Delete Confirmation Modal -->
				<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="deleteModalLabel">Delete Confirmation</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								Are you sure you want to delete <span id="accountName"></span>?
							</div>
							<div class="modal-footer">
								<form id="deleteForm" method="post" action="../includes/acc_mgmt_delete.php">
									<input type="hidden" name="admin_id" id="adminId">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
									<button type="submit" class="btn btn-danger">Delete</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!--SCRIPT FOR MODAL DELETE-->
				<script>
					// Pass data to the modal
					var deleteModal = document.getElementById('deleteModal');
					deleteModal.addEventListener('show.bs.modal', function (event) {
						var button = event.relatedTarget;
						var adminId = button.getAttribute('data-id');
						var accountName = button.getAttribute('data-name');
						var modalAccountName = deleteModal.querySelector('#accountName');
						var modalAdminId = deleteModal.querySelector('#adminId');

						modalAccountName.textContent = accountName;
						modalAdminId.value = adminId;
					});
				</script>
				<!-- MODAL -->
				<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
					<div class="modal-content">
					  <div class="modal-header">
						<h4 class="modal-title" id="staticBackdropLabel">Register new admin</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					  </div>
					  <div class="modal-body">
						<form action="../includes/register_inc.php" method="post" autocomplete="off">
							<div class="row">
								<div class="col-6">
									<div class="form-floating mb-4">
										<input type="text" class="form-control" id="floatFname" name="admin_fname" placeholder="First Name">
										<label for="floatFname">First Name</label>
									</div>
								</div>
								<div class="col">
									<div class="form-floating mb-4">
										<input type="text" class="form-control" id="floatLname" name="admin_lname" placeholder="Last Name">
										<label for="floatLname">Last Name</label>
									</div>
								</div>
							</div>
							<div class="form-floating mb-4">
 								<input type="email" class="form-control" id="floatEmail" name="admin_email" placeholder="Email">
 								<label for="floatEmail">Email</label>
							</div>
							<div class="input-group mb-3">
								<span class="input-group-text">+63</span>
								<div class="form-floating">
									<input type="tel" class="form-control" id="floatingPhoneNum" placeholder="Phone Number" name="phone_number">
									<label for="floatingPhoneNum">Phone Number</label>
								</div>
							</div>
							<div class="form-floating mb-4">
 								<input type="text" class="form-control" id="floatUser" name="admin_username" placeholder="User Name">
 								<label for="floatUser">User Name</label>
							</div>
							<div class="form-floating mb-4">
  								<input type="password" class="form-control" id="floatPassword" name="admin_password" placeholder="Password">
  								<label for="floatPassword">Password</label>
							</div>
							<div class="form-floating mb-4">
  								<input type="password" class="form-control" id="floatPasswordRpt" name="admin_password_rpt" placeholder="Password">
  								<label for="floatPasswordRpt">Repeat Password</label>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary" name="submit">Register</button>
					  		</div>
						</form>
						 <?php
							if (isset($_GET["error"])) {
                                if ($_GET["error"] == "emptyinput") {
                                    echo "<p>Fill in all fields! </p>";
                                }
                                else if ($_GET["error"] == "invalidemail") {
                                    echo "<p>Use a valid email! </p>";
                                }
                                else if ($_GET["error"] == "passunmatched") {
                                    echo "<p>Passwords don't match! </p>";
                                }
                                else if ($_GET["error"] == "usernametaken") {
                                    echo "<p>Choose another username! </p>";
                                }
                                else if ($_GET["error"] == "stmtfailure") {
                                    echo "<p>Error! Try Again!</p>";
                                }
                                else if ($_GET["error"] == "none") {
                                    echo "<p>Registered Successfully! </p>";
                                }
                            }
						?>
					  </div>
					</div>
				  </div>
				</div>
			</div>
		</div>
	</div>

<?php
	include_once 'footer.php';
?>

