<!--ADD PRODUCT MODAL-->
				<!-- MODAL-->
				<div class="modal fade" id="addProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				  	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
						<div class="modal-content">
					  		<div class="modal-header">
								<h4 class="modal-title" id="staticBackdropLabel">Add New Product</h4>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					  		</div>
					  		<div class="modal-body">
							<form action="../includes/product_inc.php" method="post" autocomplete="off">
								<!--1st row-->
								<div class="row">
									<div class="col-4">
										<div class="form-floating mb-4">
											<select class="form-select" id="floatingSelectCat" aria-label="Floating label select example" name="product_category_id">
												<option value="1" selected>Vape</option>
												<option value="2">E-liquid</option>
											</select>
											<label for="floatingSelectCat">Product Category</label>
										</div>
									</div>
									<div class="col">
										<div class="form-floating mb-4">
											<select class="form-select" id="floatingSelectType" aria-label="Floating label select example" name="product_type_id">
												<option value="1" selected>disposable pod</option>
												<option value="2">pod kit device/battery</option>
												<option value="3">pod kit e-liquid</option>
											</select>
											<label for="floatingSelectType">Product Type</label>
										</div>
									</div>
								</div>
								<!--2nd row-->
								<div class="row">
									<!--PRODUCT BRAND-->
									<div class="col-12">
										<div class="form-floating mb-4">
											<select class="form-select" id="floatingSelectType" aria-label="Floating label select example" name="brand_id">
												<option value="1" selected>BLACK</option>
												<option value="2">Flava</option>
												<option value="3">Relx</option>
												<option value="4">Elux</option>
												<option value="5">Uzuq</option>
											</select>
											<label for="floatingSelectType">Product Brand</label>
										</div>
									</div>
									<!--PRODUCT NAME-->
									<div class="col-12">
										<div class="form-floating mb-4">
											<input type="text" class="form-control" id="floatingProdName" name="product_name" placeholder="Product Name">
											<label for="floatingProdName">Product Name</label>
										</div>
									</div>
									<div class="col-12">
										<div class="form-floating mb-4">
											<input type="text" class="form-control" id="floatingSuppName" name="supplier_name" placeholder="Supplier Name">
											<label for="floatingSuppName">Supplier Name</label>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-6">
										<!--PRICE-->
										<div class="input-group mb-4">
											<span class="input-group-text">₱</span>
											<div class="form-floating">
												<input type="number" class="form-control" id="floatingSellPrice" name="selling_price" placeholder="Selling Price">
												<label for="floatingSellPrice">Selling Price</label>
											</div>
											<span class="input-group-text">.00</span>
										</div>
									</div>
									<div class="col-6">
										<!--PRICE-->
										<div class="input-group mb-4">
											<span class="input-group-text">₱</span>
											<div class="form-floating">
												<input type="number" class="form-control" id="floatingSuppPrice" name="supplier_price" placeholder="Supplier Price">
												<label for="floatingSuppPrice">Supplier Price</label>
											</div>
											<span class="input-group-text">.00</span>
										</div>
									</div>
								</div>
								<div class="col-12">
										<!--STOCK-->
										<div class="form-floating mb-4">
											<input type="number" class="form-control" id="floatFname" name="product_stock" placeholder="Product Name">
											<label for="floatFname">Product Stock</label>
										</div>
								</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary" name="submit">Add Product</button>
									</div>
							</form>
						<!--ERROR HANDLER-->
						 	<?php
							if (isset($_GET["error"])) {
                                if ($_GET["error"] == "emptyinput") {
                                    echo "<p>Empty Fields </p>";
                                }
                                else if ($_GET["error"] == "productexists") {
                                    echo "<p>Product is already in the Database! </p>";
                                }
                                else if ($_GET["error"] == "stmtfailure") {
                                    echo "<p>Error! Try Again!</p>";
                                }
                                else if ($_GET["error"] == "none") {
                                    echo "<p>Product Successfully Added </p>";
                                }
                            }
							?>
					  		</div>
						</div>
				  	</div>
				</div>
<?php
    
if ($_SERVER["REQUEST_METHOD"] == "GET"){

    $pid = $_GET["product_id"];

    require_once '../includes/db_inc.php';

    $sql = "SELECT * FROM `product` WHERE product_id = $pid";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $pbrand = $row["brand_id"];
    $pname = $row["product_name"];
    $pcat = $row["product_category_id"];
    $ptype = $row["product_type_id"];
    $pstock = $row["product_stock"];
    $psuppname = $row["supplier_name"];
    $psellprice = $row["selling_price"];
    $psuppprice = $row["supplier_price"];
}
?>


<!--EDIT PRODUCT MODALS-->
            <!--EDIT MODAL-->
				<div class="modal fade" id="editProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				  	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
						<div class="modal-content">
					  		<div class="modal-header">
								<h4 class="modal-title" id="staticBackdropLabel">Add New Product</h4>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					  		</div>
					  		<div class="modal-body">
                            <!--FORMS-->
							<form action="../includes/product_inc.php" method="post" autocomplete="off">
                                <input type="hidden" value="<?php echo $id; ?>">
								<!--1st row-->
								<div class="row">
									<div class="col-4">
										<div class="form-floating mb-4">
											<select class="form-select" id="floatingSelectCat" aria-label="Floating label select example" name="product_category_id">
												<option value="1" selected>Vape</option>
												<option value="2">E-liquid</option>
											</select>
											<label for="floatingSelectCat">Product Category</label>
										</div>
									</div>
									<div class="col">
										<div class="form-floating mb-4">
											<select class="form-select" id="floatingSelectType" aria-label="Floating label select example" name="product_type_id">
												<option value="1" selected>disposable pod</option>
												<option value="2">pod kit device/battery</option>
												<option value="3">pod kit e-liquid</option>
											</select>
											<label for="floatingSelectType">Product Type</label>
										</div>
									</div>
								</div>
								<!--2nd row-->
								<div class="row">
									<!--PRODUCT BRAND-->
									<div class="col-12">
										<div class="form-floating mb-4">
											<select class="form-select" id="floatingSelectType" aria-label="Floating label select example" name="brand_id">
												<option value="1" selected>BLACK</option>
												<option value="2">Flava</option>
												<option value="3">Relx</option>
												<option value="4">Elux</option>
												<option value="5">Uzuq</option>
											</select>
											<label for="floatingSelectType">Product Brand</label>
										</div>
									</div>
									<!--PRODUCT NAME-->
									<div class="col-12">
										<div class="form-floating mb-4">
											<input type="text" class="form-control" id="floatingProdName" name="product_name" placeholder="Product Name" value="<?php echo $pname; ?>">
											<label for="floatingProdName">Product Name</label>
										</div>
									</div>
									<div class="col-12">
										<div class="form-floating mb-4">
											<input type="text" class="form-control" id="floatingSuppName" name="supplier_name" placeholder="Supplier Name">
											<label for="floatingSuppName">Supplier Name</label>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-6">
										<!--PRICE-->
										<div class="input-group mb-4">
											<span class="input-group-text">₱</span>
											<div class="form-floating">
												<input type="number" class="form-control" id="floatingSellPrice" name="selling_price" placeholder="Selling Price">
												<label for="floatingSellPrice">Selling Price</label>
											</div>
											<span class="input-group-text">.00</span>
										</div>
									</div>
									<div class="col-6">
										<!--PRICE-->
										<div class="input-group mb-4">
											<span class="input-group-text">₱</span>
											<div class="form-floating">
												<input type="number" class="form-control" id="floatingSuppPrice" name="supplier_price" placeholder="Supplier Price">
												<label for="floatingSuppPrice">Supplier Price</label>
											</div>
											<span class="input-group-text">.00</span>
										</div>
									</div>
								</div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="submit">Edit Product</button>
                                </div>
							</form>
						<!--ERROR HANDLER-->
						 	<?php
							if (isset($_GET["error"])) {
                                if ($_GET["error"] == "emptyinput") {
                                    echo "<p>Empty Fields </p>";
                                }
                                else if ($_GET["error"] == "productexists") {
                                    echo "<p>Product is already in the Database! </p>";
                                }
                                else if ($_GET["error"] == "stmtfailure") {
                                    echo "<p>Error! Try Again!</p>";
                                }
                                else if ($_GET["error"] == "none") {
                                    echo "<p>Product Successfully Added </p>";
                                }
                            }
							?>
					  		</div>
						</div>
				  	</div>
				</div>
        