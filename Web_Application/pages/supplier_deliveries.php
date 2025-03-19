<?php
	include_once 'header_test.php';
?>
			<div class="col align-content-top bg-light">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="home.php" class="text-decoration-none">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Supplier Deliveries</li>
					</ol>
				</nav>
			<div class="card mb-4">
				<div class="card-header d-flex justify-content-between align-items-center">
					<h2 class="mb-0">Supplier Deliveries</h2>
                    <form method="POST" action="">
					<label for="filter_date">Filter by day:</label>
                        <?php
                        $today = date('Y-m-d'); // Get today's date in 'YYYY-MM-DD' format
                        $filter_date = isset($_POST['filter_date']) ? $_POST['filter_date'] : $today;
                        ?>
					<input type="date" id="filter_date" name="filter_date" value="<?php echo $filter_date; ?>">
					<input class="btn btn-primary" type="submit" name="submit" value="Filter">
				</form>
					<!--MODAL BUTTON-->
					<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSupplier">
						<i class="bi bi-database-fill-add"></i> Add New Delivery
					</button>
				</div>
				<div class="card-body">		
					<div class="table-responsive">
					<!--DATABASE TABLE-->
					<?php	
					require_once '../includes/db_inc.php';

					$sql = "SELECT supplier_delivery_id, s.supplier_name, product_name, delivery_quantity, delivery_date FROM `supplier_delivery` AS sd
                    INNER JOIN `supplier` AS s ON sd.supplier_id = s.supplier_id
                    INNER JOIN `product`AS p ON sd.product_id = p.product_id
                    ORDER BY supplier_delivery_id DESC";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					echo "<table class='table table-bordered table-striped'>
							<tr>
								<th>#ID</th>
								<th>Supplier Name</th>
                                <th>Product Name</th>
                                <th>Delivery Quantity</th>
                                <th>Delivery date</th>
                                <th>Action</th>
							</tr>";
						// output data of each row
						while($row = $result->fetch_assoc()) {
							echo "<tr>
									<td>".$row["supplier_delivery_id"]."</td>   
									<td>".$row["supplier_name"]."</td>
                                    <td>".$row["product_name"]."</td>
                                    <td>".$row["delivery_quantity"]."</td>
                                    <td>".$row["delivery_date"]."</td>
									<td class='d-flex align-items-center justify-content-evenly pb-2'>
										<button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#editModal' data-id=". $row['supplier_delivery_id']." data-name=". $row['supplier_name'].">Edit</button>
										<button class= 'btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteModal' data-id='".$row['supplier_delivery_id']." 'data-name='".$row['supplier_name']."'><i class='bi bi-trash3-fill'></i></button>
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
								Are you sure you want to delete <span id="supplierName"></span>'s Delivery ?
							</div>
							<div class="modal-footer">
								<form id="deleteForm" method="post" action="../includes/supp_dev_delete.php">
									<input type="hidden" name="supplier_delivery_id" id="suppDevId">
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
						<h4 class="modal-title" id="staticBackdropLabel">Add New Delivery</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					  </div>
					  <div class="modal-body">
						<form action="../includes/supp_dev_add.php" method="post" autocomplete="off">

							<div class="form-floating mb-4">
 								
                                <select class="form-select" name="supplier_id" id="suppName" aria-label="Floating label" required>
                                    <option value="" disabled selected>Select supplier</option>
                                    <?php
                                    include '../includes/db_inc.php';
                                    
                                    $sql = "SELECT supplier_id, supplier_name FROM `supplier`";
                                    $result = $conn->query($sql);
                        
                                    if ($result->num_rows > 0) {
                                        // Output data of each row
                                        while($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row["supplier_id"] . "'>" . $row["supplier_name"] . "</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No items available</option>";
                                    }
                                    $conn->close();
                                    ?>
								</select>
								<label for="suppName">Select Item</label>
							</div>
							<div class="form-floating mb-4">
                                 <select class="form-select" name="product_id" id="productName" aria-label="Floating label" required>
									<option value="" disabled selected>Select an item</option>
									<?php
									include '../includes/db_inc.php';
									
									$sql = "SELECT product_id, product_name FROM `product`";
									$result = $conn->query($sql);
						
									if ($result->num_rows > 0) {
										// Output data of each row
										while($row = $result->fetch_assoc()) {
											echo "<option value='" . $row["product_id"] . "'>" . $row["product_name"] . "</option>";
										}
									} else {
										echo "<option value=''>No items available</option>";
									}
									$conn->close();
									?>
								</select>
								<label for="productName">Select Item</label>
							</div>
                            <div class="form-floating mb-4">
 								<input type="number" class="form-control" id="floatSuppAdd" name="delivery_quantity" placeholder="Supplier Address">
 								<label for="floatSuppAdd">Delivery Quantity</label>
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