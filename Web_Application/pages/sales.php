<?php
	include_once 'header_test.php';
?>

<div class="col align-content-top bg-light">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.php" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sales Record</li>
            </ol>
			
        </nav>
	<div class="card mb-4">
			<div class="card-header d-flex justify-content-between align-items-center">
				<h2 class="mb-0">Sales Record</h2>
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
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
					<i class="bi bi-bag-plus-fill"></i> Add New Sales
				</button>
			</div>
        
        <?php	
				

				if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['filter_date'])) {
					$filter_date = $_POST['filter_date'];
				} else {
					$filter_date = $today;
				}
					
				$sql = "SELECT sales_id, customer_name, product_name, item_quantity, total_price, date_purchased FROM `sale` 
                INNER JOIN `product` ON sale.product_item_id = product.product_id WHERE DATE(date_purchased)=?
				ORDER BY sales_id DESC";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param("s", $filter_date);
				$stmt->execute();
				$result = $stmt->get_result();

				if ($result->num_rows > 0) {
				echo "<table class='table table-bordered table-striped'>
						<tr>
							<th>#ID</th>
							<th>Customer Name</th>
							<th>Product Name</th>
							<th>Item Quantity</th>
							<th>Total Price</th>
							<th>Date Purchased</th>
                            <th>Action</th>
						</tr>";
					// output data of each row
					while($row = $result->fetch_assoc()) {
						echo "<tr>
								<td>".$row["sales_id"]."</td>
                                <td>".$row["customer_name"]."</td>
								<td>".$row["product_name"]."</td>
								<td>".$row["item_quantity"]."</td>
								<td> ₱".$row["total_price"]."</td>
								<td>".$row["date_purchased"]."</td>
								<td>
                                    <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#staticBackdrop'><i class='bi bi-pencil-fill'></i></button>
                                    <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#confirmDelete'><i class='bi bi-trash3-fill'></i></button>

    <div class='modal fade' id='confirmDelete' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
                        <div class='modal-dialog modal-dialog-centered modal-dialog-scrollable'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                <h4 class='modal-title' id='staticBackdropLabel'>Delete Sales Record?</h4>
                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                </div>
                                <div class='modal-footer'>
                                    <button type='button' class='btn btn-primary' data-bs-dismiss='modal'>Cancel</button>
                                    <a class='btn btn-danger' href='../includes/sales_delete.php?sales_id=$row[sales_id]'>Confirm</a>
                                </div>
                            </div>
                        </div>
                    </div>	
                                </td>
							</tr>";
					} 
				echo "</table>";
				} else {
				echo "<h3> 0 results </h3>";
				}
				
				?>

            </div>
            <!-- MODAL -->
				<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
					<div class="modal-content">
					  <div class="modal-header">
						<h4 class="modal-title" id="staticBackdropLabel">Add New Sales Record</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					  </div>
					  <div class="modal-body">
						<form action="../includes/sales_inc.php" method="post" autocomplete="off">
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="floatCname" name="customer_name" placeholder="Customer Name">
                                <label for="floatCname">Customer Name</label>
                            </div>
                            <div class="form-floating mb-4">
								<select class="form-select" name="product_item_id" id="productName" aria-label="Floating label" required>
									<option value="" disabled selected>Select an item</option>
									<?php
									//require_once '../includes/db_inc.php';
									
									// SQL query to fetch item_id and item_name from the table
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
 								<input type="number" class="form-control" id="floatItem" name="item_quantity" placeholder="Item Quantity">
 								<label for="floatItem">Item Quantity</label>
							</div>
							<div class="form-floating mb-4">
 								<input type="number" class="form-control" id="floatPrice" name="total_price" placeholder="Price Total">
 								<label for="floatPrice">Total Price</label>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary" name="submit">Add Sales</button>
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