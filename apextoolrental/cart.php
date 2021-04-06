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
        <a class="nav-link nav-links" href="home.php">Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link nav-links" href="create-order.php">Create Order</a>
      </li>
	  <li class="nav-item active">
        <a class="nav-link nav-links" href="cart.php">Shopping Cart <?php
		if (empty($_SESSION["cartNum"]) == FALSE) {
			echo "(".$_SESSION["cartNum"]." items)";
		}
		?></a>
      </li>
<?php
	include_once 'nav2.php';
?>




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



<div class="orders">
	
<?php include_once 'includes/cart.inc.php'; ?>

<?php
if (empty($_SESSION["cartNum"]) !== TRUE) {
	echo "
	<form action='includes/order.inc.php' method='post'>
		<div class='form-row'>
			<div class='col'>
				<label for='orderStart'>Rental Start:</label>
				<input type='text' name='orderStart' id='orderStart' class='form-control' placeholder='YYYY-MM-DD' required>
			</div>
			<div class='col'>
				<label for='orderEnd'>Rental End:</label>
				<input type='text' name='orderEnd' id='orderEnd' class='form-control' placeholder='YYYY-MM-DD' required>
			</div>
		</div>
		<br><br>
		<div id='signup_submit'>
			<button class='btn btn-primary' style='padding: 0.4rem 3rem !important;' type='submit' name='submitOrder'>Place Order</button>
		</div>
	</form>
	
	";
}
?>
	
	
	
	
	
</div>	



<?php
	include_once 'footer.php';
?>