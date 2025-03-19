<?php
	include_once 'header_test.php';
?>
			<div class="col align-content-top bg-light">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="home.php" class="text-decoration-none">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Product Stock</li>
					</ol>
				</nav>
			<div class="card mb-4">
				<div class="card-header d-flex justify-content-between align-items-center">
					<h2 class="mb-0">Product Stock</h2>
					<!--MODAL BUTTON-->
					<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProduct">
						<i class="bi bi-database-fill-add"></i> Add New Product
					</button>
				</div>
				<div class="card-body">		
					<div class="table-responsive">
					<!--DATABASE TABLE-->
					<?php	
					require_once '../includes/db_inc.php';

					$sql = "SELECT product_id, brand_name, product_name, category_name, type_name, product_stock, 
					supplier_price, selling_price, supplier_name, product_added, product_modified FROM `product`
					INNER JOIN `category` ON product.product_category_id = category.cat_id
					INNER JOIN `type` ON product.product_type_id = type.type_id
					INNER JOIN `brands` ON product.brand_id = brands.brand_id";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					echo "<table class='table table-bordered table-striped'>
							<tr>
								<th>#ID</th>
								<th>Product Name</th>
								<th>Category/Type</th>
								<th>Stock</th>
								<th>Supplier Price</th>
								<th>Selling Price</th>
								<th>Supplier</th>
								<th>Product Added</th>
								<th>Product Modified</th>
								<th>Action</th>
							</tr>";
						// output data of each row
						while($row = $result->fetch_assoc()) {
							echo "<tr>
									<td>".$row["product_id"]."</td>
									<td>".$row["brand_name"]." ".$row["product_name"]."</td>
									<td>".$row["category_name"]."-".$row["type_name"]."</td>
									<td>".$row["product_stock"]."</td>
									<td> ₱".$row["supplier_price"]."</td>
									<td> ₱".$row["selling_price"]."</td>
									<td>".$row["supplier_name"]."</td>
									<td>".$row["product_added"]."</td>
									<td>".$row["product_modified"]."</td>
									<td class='d-flex align-items-center justify-content-evenly pb-5'>
										<button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#editModal' data-id=". $row['product_id']." data-name=". $row['product_name']."><i class='bi bi-pencil-fill'></i></button>
										<button class= 'btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteModal' data-id='".$row['product_id']." 'data-name='".$row['brand_name']." ".$row['product_name']."'><i class='bi bi-trash3-fill'></i></button>
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
								Are you sure you want to delete <span id="productName"></span>?
							</div>
							<div class="modal-footer">
								<form id="deleteForm" method="post" action="../includes/product_delete.php">
									<input type="hidden" name="product_id" id="productId">
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
						var productId = button.getAttribute('data-id');
						var productName = button.getAttribute('data-name');
						var modalProductName = deleteModal.querySelector('#productName');
						var modalProductId = deleteModal.querySelector('#productId');

						modalProductName.textContent = productName;
						modalProductId.value = productId;
					});
				</script>
			
<?php
	include_once 'footer.php';
?>       