<?php
	include_once 'header_test.php';
//$dataPoints name
	$dataPointsMSBG = array( 
		array("y" => 30, "label" => "BLACK Elite 8000" ),
		array("y" => 27, "label" => "FLAVA Xtre 10000" ),
		array("y" => 14, "label" => "Shift x Chillax Vista 15k" ),
		array("y" => 10, "label" => "BLACK Infinity" ),
	);

	$dataPointsWR = array(
		array("y" => 2500.00, "label" => "Sunday"),
		array("y" => 1500.00, "label" => "Monday"),
		array("y" => 540.00, "label" => "Tuesday"),
		array("y" => 3000.00, "label" => "Wednesday"),
		array("y" => 2490.00, "label" => "Thursday"),
		array("y" => 1300.00, "label" => "Friday"),
		array("y" => 980.00, "label" => "Saturday")
	);
	
	//DATAPOINTS WEEKLY MOST SOLD PRODUCTS

	

	$dataRevenue = array();
	$count = 0;

	$sql = "SELECT SUM(total_price) AS total_items_price FROM `sale`
	INNER JOIN `product` ON sale.product_item_id = product.product_id
	GROUP BY date_purchased";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()) {
		$dataRevenue[$count]["label"]= $row["total_items_price"];
		$dataRevenue[$count]["y"]= $row["total_items_price"];
		$count = $count + 1;

	}


?>

		    <div class="col bg-light">
                <div class="row">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="home.php" class="text-decoration-none">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
						</ol>
					</nav>
					<!--WEEKLY-->
                    <div class="col card">
						<div class="card-header d-flex justify-content-between align-items-center">
							<h2 class="mb-0">Weekly Analysis</h2>
							<form method="POST" action="">
								<label for="filter_week">Select Week:</label>
								<?php
								$currentWeek = date('Y-\WW'); // Get the current week in 'YYYY-Www' format
								$filter_week = isset($_POST['filter_week']) ? $_POST['filter_week'] : $currentWeek;
								?>
								<input type="week" id="filter_week" name="filter_week" value="<?php echo $filter_week; ?>">
								<input class="btn btn-primary" type="submit" name="submit" value="Filter">
							</form>
						</div>
						<div class="card-body d-flex flex-row">
					<!--WEEKLY TOP SELLING PRODUCTS/ TOP 3-->
							<?php
							// Check if the form was submitted and set the filter week accordingly
							if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['filter_week'])) {
								$filter_week = $_POST['filter_week'];
							} else {
								$filter_week = $currentWeek;
							}

							// Convert the week format 'YYYY-Www' to a date range
							$year = substr($filter_week, 0, 4);
							$week = substr($filter_week, 6, 2);

							// Calculate the start and end dates of the week
							$start_date = date('Y-m-d', strtotime($year . 'W' . $week . '1'));
							$end_date = date('Y-m-d', strtotime($year . 'W' . $week . '7'));

							$sql = "SELECT DISTINCT brand_name, product_name FROM `sale`
							INNER JOIN `product` ON sale.product_item_id = product.product_id
							INNER JOIN `brands` ON product.brand_id = brands.brand_id
							WHERE DATE(date_purchased) BETWEEN ? AND ? 
							ORDER BY item_quantity DESC LIMIT 3";
							$stmt = $conn->prepare($sql);
							$stmt->bind_param("ss", $start_date, $end_date);
							$stmt->execute();
							$result = $stmt->get_result();
							
							$counter= 1;

							if ($result->num_rows > 0) {
								echo "<table class='table table-bordered table-striped'>
										<tr>
											<th colspan='2' class>Top selling products</th>
										</tr>
										<tr>
											<th>Rank</th>
											<th>Product Name</th>
										</tr>";
									// output data of each row
									while($row = $result->fetch_assoc()) {
										echo "<tr>
												<td>$counter</td>
												<td>".$row["brand_name"]." ".$row["product_name"]."</td>
											</tr>";
											$counter++;
									} 
								echo "</table>";
								} else {
								echo "<h3> 0 results </h3>";
								}

							// Close the prepared statement
							$stmt->close();
							?>
							
					<!--WEEKLY MOST SOLD PRODUCTS BAR GRAPH-->
							<?php
							// Check if the form was submitted and set the filter week accordingly
							if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['filter_week'])) {
								$filter_week = $_POST['filter_week'];
							} else {
								$filter_week = $currentWeek;
							}

							// Convert the week format 'YYYY-Www' to a date range
							$year = substr($filter_week, 0, 4);
							$week = substr($filter_week, 6, 2);

							// Calculate the start and end dates of the week
							$start_date = date('Y-m-d', strtotime($year . 'W' . $week . '1'));
							$end_date = date('Y-m-d', strtotime($year . 'W' . $week . '7'));

							$sql = "SELECT product_name, SUM(item_quantity) AS total_items FROM `sale`
							INNER JOIN `product` ON sale.product_item_id = product.product_id
							WHERE DATE(date_purchased) BETWEEN ? AND ? 
							GROUP BY product_name
							ORDER BY total_items DESC LIMIT 4";
							$stmt = $conn->prepare($sql);
							$stmt->bind_param("ss", $start_date, $end_date);
							$stmt->execute();
							$result = $stmt->get_result();
							
							$dataRevenue = array();
							$count = 0;

							while($row = $result->fetch_assoc()) {
								$dataProducts[$count]["label"]= $row["product_name"];
								$dataProducts[$count]["y"]= $row["total_items"];
								$count = $count + 1;
						
							}

							$stmt->close();
							?>
					<!--WEEKLY REVENUE BAR GRAPH-->
						<?php
						?>

					<script>
						window.onload = function() {
						//Most Sold chart
						var MSchart = new CanvasJS.Chart("mostSoldBarGraph", {
							animationEnabled: true,
							title: {
								text: "Most Sold Products"
							},
							
							axisY: {
								title: "Number of Items"
							},
							data: [{
								type: "column",
								yValueFormatString: "### items",
								dataPoints: <?php echo json_encode($dataProducts, JSON_NUMERIC_CHECK); ?>
							}]
						});
						MSchart.render();
						
						//Weekly Revenue chart
						var WRchart = new CanvasJS.Chart("weeklyRevenueGraph", {
							title: {
								text: "Weekly Revenue"
							},

							axisY: {
								title: "Revenue",
								prefix: "₱",
							},
							data: [{
								type: "line",
								yValueFormatString: "₱#,##0.##",
								dataPoints: <?php echo json_encode($dataPointsWR, JSON_NUMERIC_CHECK); ?>
							}]
						});
						WRchart.render();
						
					}
					</script>
							<div id="mostSoldBarGraph" style="height: 200px; width: 100%;"></div>
								<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
							
							<div id="weeklyRevenueGraph" style="height: 200px; width: 100%;"></div>
								<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
						</div>
					</div>
                </div>
				<!--DAILY-->
				<div class="row py-2">
					<div class="col card">
						<div class="card-header d-flex justify-content-between align-items-center">
							<h2 class="mb-0">Daily Analysis</h2>
							<form method="POST" action="">
								<label for="filter_date">Filter by day:</label>
								<?php
								$today = date('Y-m-d'); // Get today's date in 'YYYY-MM-DD' format
								$filter_date = isset($_POST['filter_date']) ? $_POST['filter_date'] : $today;
								?>
								<input type="date" id="filter_date" name="filter_date" value="<?php echo $filter_date; ?>">
								<input class="btn btn-primary" type="submit" name="submit" value="Filter">
							</form>
						</div>
						<!--DAILY REVENUE-->
						<div class="card-body d-flex flex-row justify-content-center">
							<div class="card mx-2">
								<div class="card-body">
									<h2 class="card-title text-center align-ite">Daily Revenue</h2>
									<br><br>
									<?php
									if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['filter_date'])) {
										$filter_date = $_POST['filter_date'];
									} else {
										$filter_date = $today;
									}
										
										$sql = "SELECT SUM(total_price) AS total_items_price FROM `sale`WHERE DATE(date_purchased)=?";
										$stmt = $conn->prepare($sql);
										$stmt->bind_param("s", $filter_date);
										$stmt->execute();
										$result = $stmt->get_result();

										if ($result->num_rows > 0) {
											// Fetch the result as an associative array
											$row = $result->fetch_assoc();
											echo "<p class='text-center'> ₱" . $row['total_items_price']. "</p>";
										} else {
											echo "<p class='text-center'> ₱ 0 </p>";
										}

										$stmt->close();
									
									?>
								</div>
							</div>
							<!--DAILY ITEMS SOLD-->
							<div class="card mx-2">
								<div class="card-body">
									<h2 class="card-title text-center">Items Sold</h2>
									<br><br>
									<?php
									if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['filter_date'])) {
										$filter_date = $_POST['filter_date'];
									} else {
										$filter_date = $today;
									}
										
										$sql = "SELECT SUM(item_quantity) AS total_items FROM `sale` WHERE DATE(date_purchased)=?";
										$stmt = $conn->prepare($sql);
										$stmt->bind_param("s", $filter_date);
										$stmt->execute();
										$result = $stmt->get_result();

										if ($result->num_rows > 0) {
											// Fetch the result as an associative array
											$row = $result->fetch_assoc();
											echo "<p class='text-center'>" . $row['total_items']. " items </p>";
										} else {
											echo "<p class='text-center'> 0 items</p>";
										}

										$stmt->close();
									
									?>
								</div>
							</div>
							<!--RECENTLY SOLD PRODUCTS-->
							<div class="card mx-2">
								<div class="card-body">
									<h2 class="card-title text-center">Recently Sold Products</h2>
									<?php

									// Check if the form was submitted and set the filter date accordingly
									if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['filter_date'])) {
										$filter_date = $_POST['filter_date'];
									} else {
										$filter_date = $today;
									}

									$sql = "SELECT customer_name, product_name, total_price, item_quantity FROM `sale`
									INNER JOIN `product` ON sale.product_item_id = product.product_id WHERE DATE(date_purchased)=? ORDER BY date_purchased DESC LIMIT 3 ";
									$stmt = $conn->prepare($sql);
									$stmt->bind_param("s", $filter_date);
									$stmt->execute();
									$result = $stmt->get_result();

									if ($result->num_rows > 0) {
										echo "<table class='table table-bordered table-striped'>
												<tr>
													<th>Customer Name</th>
													<th>Product Name</th>
													<th>Item Quantity</th>
													<th>Item Price</th>

												</tr>";
											// output data of each row
											while($row = $result->fetch_assoc()) {
												echo "<tr>

														<td>".$row["customer_name"]."</td>
														<td>".$row["product_name"]."</td>
														<td>".$row["item_quantity"]."</td>
														<td>".$row["total_price"]. "</td>
													</tr>";
											} 
										echo "</table>";
										} else {
										echo "<h3> 0 results </h3>";
										}

									// Close the prepared statement
									$stmt->close();
									$conn->close();
									?>
									
								</div>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
	
	
<?php
	include_once '../pages/footer.php';
?>

