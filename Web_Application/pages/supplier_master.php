<?php
	include_once 'header_test.php';
?>
			<div class="col align-content-top bg-light">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="home.php" class="text-decoration-none">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Supplier List</li>
					</ol>
				</nav>
			<div class="card mb-4">
				<div class="card-header d-flex justify-content-between align-items-center">
					<h2 class="mb-0">Supplier List</h2>
					<!--MODAL BUTTON-->
					<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSupplier">
						<i class="bi bi-database-fill-add"></i> Add New Supplier
					</button>
				</div>
				<div class="card-body">		
					<div class="table-responsive">
					<!--DATABASE TABLE-->
					<?php	
					require_once '../includes/db_inc.php';

					$sql = "SELECT supplier_id, supplier_name, supplier_address FROM `supplier`";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					echo "<table class='table table-bordered table-striped'>
							<tr>
								<th>#ID</th>
								<th>Supplier Name</th>
                                <th>Supplier Address</th>
                                <th>Action</th>
							</tr>";
						// output data of each row
						while($row = $result->fetch_assoc()) {
							echo "<tr>
									<td>".$row["supplier_id"]."</td>
									<td>".$row["supplier_name"]."</td>
                                    <td>".$row["supplier_address"]."</td>
									<td class='d-flex align-items-center justify-content-evenly pb-2'>
										<button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#editModal' data-id=". $row['supplier_id']." data-name=". $row['supplier_name'].">Edit</button>
										<button class= 'btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteModal' data-id='".$row['supplier_id']." 'data-name='".$row['supplier_name']."'><i class='bi bi-trash3-fill'></i></button>
									</td>
								</tr>";
						} 
					echo "</table>";
					} else {
					echo "<h3> 0 results </h3>";
					}
					
					?>
					</div>
				</div>
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
								Are you sure you want to delete <span id="supplierName"></span>?
							</div>
							<div class="modal-footer">
								<form id="deleteForm" method="post" action="../includes/supplier_delete.php">
									<input type="hidden" name="supplier_id" id="supplierId">
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
						var supplierId = button.getAttribute('data-id');
						var supplierName = button.getAttribute('data-name');
						var modalSupplierName = deleteModal.querySelector('#supplierName');
						var modalSupplierId = deleteModal.querySelector('#supplierId');

						modalSupplierName.textContent = supplierName;
						modalSupplierId.value = supplierId;
					});
				</script>
			<!-- MODAL -->
            <div class="modal fade" id="addSupplier" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
					<div class="modal-content">
					  <div class="modal-header">
						<h4 class="modal-title" id="staticBackdropLabel">Add New Supplier</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					  </div>
					  <div class="modal-body">
						<form action="../includes/supplier_add.php" method="post" autocomplete="off">

							<div class="form-floating mb-4">
 								<input type="text" class="form-control" id="floatSuppName" name="supplier_name" placeholder="Supplier Name">
 								<label for="floatSuppName">Supplier Name</label>
							</div>
							<div class="form-floating mb-4">
 								<input type="text" class="form-control" id="floatSuppAdd" name="supplier_address" placeholder="Supplier Address">
 								<label for="floatSuppAdd">Supplier Address</label>
							</div>

							<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary" name="submit">Add</button>
					  		</div>
						</form>
						 <?php
							if (isset($_GET["error"])) {
                                if ($_GET["error"] == "emptyinput") {
                                    echo "<p>Fill in all fields! </p>";
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

            <!--EDIT MODAL -->
            <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
					<div class="modal-content">
					  <div class="modal-header">
						<h4 class="modal-title" id="staticBackdropLabel">Edit Supplier Details</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					  </div>
					  <div class="modal-body">
                        <?php
                            if(isset($_GET["supplier_id"])) {
                                $supid = $_GET["supplier_id"];

                                require_once '../includes/db_inc.php';

                                $sql = "SELECT supplier_name, supplier_address FROM `supplier` WHERE supplier_id = $supid";
                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();
                            }
                        ?>
						<form action="../includes/supplier_edit.php" method="post" autocomplete="off">

							<div class="form-floating mb-4">
 								<input type="text" class="form-control" id="floatSuppName" value="<?php echo $row["supplier_name"];?>" name="supplier_name" placeholder="Supplier Name">
 								<label for="floatSuppName">Supplier Name</label>
							</div>
							<div class="form-floating mb-4">
 								<input type="text" class="form-control" id="floatSuppAdd" value="<?php echo $row["supplier_address"];?>" name="supplier_address" placeholder="Supplier Address">
 								<label for="floatSuppAdd">Supplier Address</label>
							</div>

							<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary" name="submit">Add</button>
					  		</div>
						</form>
						 <?php
							if (isset($_GET["error"])) {
                                if ($_GET["error"] == "emptyinput") {
                                    echo "<p>Fill in all fields! </p>";
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

<?php
	include_once 'footer.php';
?>       