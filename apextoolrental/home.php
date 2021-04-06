<?php
	include_once 'header.php';
	require_once 'includes/dbh.inc.php';
	require_once 'includes/functions.inc.php';
	include_once 'nav1.php';
	$sql = "SELECT SUM(qty) FROM cart";
	$result = mysqli_query($conn, $sql);
	$_SESSION["cartNum"] = $result->fetch_array()[0] ?? '';
?>
      <li class="nav-item active">
        <a class="nav-link nav-links" href="home.php">Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link nav-links" href="create-order.php">Create Order</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link nav-links" href="cart.php">Shopping Cart <?php
		if (empty($_SESSION["cartNum"]) == FALSE) {
			echo "(".$_SESSION["cartNum"]." items)";
		}
		?></a>
      </li>
<?php
	include_once 'nav2.php';
	accountLink($conn);
	if ($_POST["customerAccount"] === 1) {
		header("location: signup-business.php");
	}

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
<?php
	if (isset($_GET["error"])) {
		if ($_GET["error"] == "none") {
		echo '<div class="btn btn-success btn-block">Order Successfully Placed!</div><br>';
		}
	}
?>
	<div class="tabletag"><u>Open Orders</u></div>
	<div class='tabletag2'><i>*Click on an order to expand the details.</i></div>
		<?php require_once 'includes/table.inc.php';?>
		<br>

	<div class="tabletag"><u>Complete Orders</u></div>
	<div class='tabletag2'><i>*Click on an order to expand the details.</i></div>
		<?php require_once 'includes/table2.inc.php';?>
</div>




<?php
	include_once 'footer.php';
?>