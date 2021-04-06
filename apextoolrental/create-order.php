<?php
	include_once 'header.php';
	include_once 'nav1.php';
	require_once 'includes/dbh.inc.php';
	require_once 'includes/functions.inc.php';
	$sql = "SELECT SUM(qty) FROM cart";
	$result = mysqli_query($conn, $sql);
	$_SESSION["cartNum"] = $result->fetch_array()[0] ?? '';
?>
  
	
	  <li class="nav-item">
        <a class="nav-link nav-links" href="home.php">Home</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link nav-links" href="create-order.php">Create Order<span class="sr-only">(current)</span></a>
      </li>
	  <li class="nav-item">
        <a class="nav-link nav-links" href="cart.php">Shopping Cart
		<?php
		if (empty($_SESSION["cartNum"]) == FALSE) {
			echo "(".$_SESSION["cartNum"]." items)";
		}
		?>
		</a>
      </li>
<?php 
	include_once 'nav2.php';
	
	include_once 'includes/shoppingcart.inc.php';
	if (isset($_POST["submit"])) {
		$_SESSION["store"] = $_POST["store"];
	}
?>    

<div class="create-orders">
<div id='storeset' class='modal fade'>
	<div class='modal-dialog'>
		<div class='modal-content'>
			<form method='post'>
				<div class='modal-header'>
					<h5>Select a store to begin creating an order:</h5>
				</div>
				<div class='modal-body' style='padding-left:2rem;'>
					<div class='radio'>
					  <label><input type='radio' name='store' value='1'>&nbsp Downtown Toronto</label>
					</div>
					<div class='radio'>
					  <label><input type='radio' name='store' value='3'>&nbsp North York</label>
					</div>
					<div class='radio'>
					  <label><input type='radio' name='store' value='2'>&nbsp Quebec City</label>
					</div>
				</div>
				<div class='modal-footer'>
					<button class='btn btn-primary' type='submit' name='submit'>Continue</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="sidebar">
	<div class="sidebar-head">
		<div class="storeSelect">
			Store: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button class="change-store" data-toggle="modal" data-target="#storeset">Change Store</button>
			<br>
			<h5><?php
					if (empty($_SESSION["store"]) == FALSE) {
					$sql = "SELECT storeName FROM store WHERE storeID = ".$_SESSION["store"];
					$result = mysqli_query($conn, $sql);
					$storeName = $result->fetch_array()[0] ?? '';
					echo $storeName; 
					}
				?>
			</h5>
		</div>
	</div>
	<br>
	<div class="sidebar-body">
		<h6 style="padding-left: 1.2rem; padding-bottom: 7px; border-bottom: 1px solid grey; margin-bottom: 0px">Shop by Category:</h6>
		<div>
		<button class='categorybtn1'>All Categories</button><br>
		<?php
		$sql = "SELECT COUNT(cateogryID) FROM category";
		$result = mysqli_query($conn, $sql);
		$totcat = $result->fetch_array()[0] ?? '';
		$i = 0;
		while ($i < $totcat) {
			$i = $i + 1;
			$sql = "SELECT category FROM category WHERE cateogryID = " . $i;
			$result = mysqli_query($conn, $sql);
			$category = $result->fetch_array()[0] ?? '';
			echo "<button class='categorybtn ". $i ."' href='".$category.".php'>".$category."</button><br>";
		}
		?>
		</div>
	</div>
	<div class="sidebar-foot mt-auto">
		<a type="button" class="btn btn-dark btn-block" href="home.php">About Apex Tools</a>
	</div>
</div>

<div class="orders"><br>
	<div class="row">
		
		
		<?php
		if (empty($_SESSION["store"]) == FALSE) {
			$i = 0;
			$j = 0;
			$sql = "SELECT COUNT(sku.SKU) FROM sku";
			$result = mysqli_query($conn, $sql);
			$skuTotal = $result->fetch_array()[0] ?? '';
			
			WHILE ($i < $skuTotal) {
				$i = $i + 1;
				$sql = "SELECT sku.SKU FROM sku
						INNER JOIN tool ON sku.SKU = tool.SKU
						INNER JOIN tool_inspection ON tool.toolID = tool_inspection.toolID
						WHERE tool.storeID = ".$_SESSION["store"]." AND sku.SKU = ".$i." AND tool_inspection.inspectionStatusID = 1
						GROUP BY sku.SKU";
				$result = mysqli_query($conn, $sql);
				$inStock = $result->fetch_array()[0] ?? '';
				
				if (empty($inStock) == FALSE) {
					$j = $j + 1;
					$sql = "SELECT sku.toolName FROM sku WHERE sku.SKU = ".$i;
					$result = mysqli_query($conn, $sql);
					$name = $result->fetch_array()[0] ?? '';
					$sql = "SELECT sku.toolDescription FROM sku WHERE sku.SKU = ".$i;
					$result = mysqli_query($conn, $sql);
					$description = $result->fetch_array()[0] ?? '';
					$sql = "SELECT sku.toolImage FROM sku WHERE sku.SKU = ".$i;
					$result = mysqli_query($conn, $sql);
					$image = $result->fetch_array()[0] ?? '';
					
					$sql = "SELECT pricePerHour FROM price_version 
							INNER JOIN sku ON price_version.priceVersionID = sku.priceVersionID
							WHERE sku.SKU = ".$i;
					$result = mysqli_query($conn, $sql);
					$p = $result->fetch_array()[0] ?? '';
					$priceph = number_format((float)$p, 2, '.', '');
					
					echo "
						<div class='col-sm-3'>
							<div class='card productcard' style='width: 14rem; height: 27rem; margin-bottom: 1.7rem;'>
								<img class='card-img-top' src='images/".$image."'>
								<div class='card-body'>
									<h5 class='card-title'>".$name."</h5>
									<p class='card-text'>".$description."</p>
									<button class='btn btn-primary' data-toggle='modal' data-target='#sku".$i."'>Details</button>
								</div>
							</div>
						</div>
						
						<div id='sku".$i."' class='modal fade'>
							<div class='modal-dialog modal-xl'>
								<div class='modal-content'>
									<form method='post'>
										<div class='modal-header'>
											<h3>".$name."</h3>
										</div>
										<div class='modal-body' style='padding-left:2rem;'>
											<div class='row'>
												<div class='col-6'>
													<img src='images/".$i.".jpg' style='height: 400px;'>
												</div>
												<div class='col-6'>
													Price Per Hour&nbsp <h3 style='display: inline-block;'>$ ".$priceph."</h3>
													<br><br>
													<label for='qty'>Quantity:</label>
													<input type='number' name='qty".$i."' class='form-control' placeholder='quantity' required>
												</div>
											</div>
										</div>
										<div class='modal-footer'>
											<button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
											<button class='btn btn-primary' type='submit' name='addcart".$i."'>Add to cart</button>
											
											
											
											
											
										</div>
									</form>
								</div>
							</div>
						</div>
					";
				
				}
			}
			if ($j < 1) {
				echo "<div class='notools'><p>There are no tools available at this location. Please select a different store to continue.</p></div>";
			}
		}	
		?>
	</div>
</div></div>
<?php
	include_once 'footer.php';
?>