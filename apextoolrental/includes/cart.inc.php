<?php

$sql = "SELECT MIN(cartID) FROM cart";
$result = mysqli_query($conn, $sql);
$minCart = $result->fetch_array()[0] ?? '';

if (empty($minCart)) {
	echo "<div class='notools'><p>There are no tools in your shopping cart.</p><a class='btn btn-primary' type='button' href='create-order.php' style='padding: 0.2rem 1.5rem !important; font-size: 1.3rem !important;'>Browse Tools</a></div><br></div>";


}

else {
	$sql = "SELECT COUNT(skuID) FROM cart";
	$result = mysqli_query($conn, $sql);
	$cartots = $result->fetch_array()[0] ?? '';
	
	
	$maxCart = $minCart + $cartots;
	$i = $minCart;
	$line = 1;
	
	echo "<div class='tabletag'><u>Shopping Cart</u></div><div class='table-responsive'>
		<table class='table table-striped'>
			<thead class='thead-dark tablehead'>
				<tr>
					<th scope='col'>#</td>
					<th scope='col'>Tool Name</td>
					<th scope='col'>Quantity</td>
				</tr>
			</thead>
			<tbody class='tablebody'>";
	
	WHILE ($i < $maxCart) {
		$sql = "SELECT skuID FROM cart WHERE cartID = ".$i;
		$result = mysqli_query($conn, $sql);
		$skuID = $result->fetch_array()[0] ?? '';
		
		$sql = "SELECT sku.toolName FROM sku WHERE sku.SKU = ".$skuID.";";
		$result = mysqli_query($conn, $sql);
		if (empty($result) == FALSE) {
			$toolName = $result->fetch_array()[0] ?? '';
		}
		$sql = "SELECT qty FROM cart WHERE cartID = ".$i;
		$result = mysqli_query($conn, $sql);
		$qty = $result->fetch_array()[0] ?? '';
		
		echo "
			<tr>
				<th>".$line."</th>
				<td>".$toolName."</td>
				<td>".$qty."</td>
			</tr>";
		
		$line = $line + 1;
		$i = $i + 1;
	
	}
	
	echo "</tbody></table></div><br>";
}