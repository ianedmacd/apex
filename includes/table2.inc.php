<?php
require_once 'dbh.inc.php';


$sql = "SELECT `order`.`orderID`, `person`.`firstName`, `person`.`lastName`, `store`.`storeName`, `order_status`.`orderStatus` 
		FROM `order` 
		LEFT JOIN `person` ON `order`.`acceptedByID` = `person`.`personID` 
		LEFT JOIN `store` ON `order`.`storeID` = `store`.`storeID` 
		LEFT JOIN `order_status` ON `order`.`orderStatusID` = `order_status`.`orderStatusID` 
		WHERE `order_status`.`orderStatusID`>=8 
		ORDER BY `order_status`.`orderStatusID`";
$result = $conn->query($sql);

$i = 50;
if ($result->num_rows > 0) {
	while ($row = $result-> fetch_assoc()) {
		echo "
		
			<tr class='accordion-toggle collapsed' id='accordion".$i."' data-toggle='collapse' data-parent='#accordion".$i."' href='#collapse".$i."'>
				<th>". $row['orderID'] ."</th>
				<td>". $row['storeName'] ."</td>
				<td>". $row['firstName'] ."&nbsp". $row['lastName'] ."</td>
				<td>". $row['orderStatus'] ."</td>
			</tr>
			
			<tr class='hide-table-padding'>
				<td></td>
				<td colspan='3'>
					<div id='collapse".$i."' class='collapse in p-3'>
						<div class='row'>
							<div class='col-3'><h5><u>Tool</u></h5></div>
							<div class='col-3'><h5><u>Delivery</u></h5></div>
							<div class='col-3'><h5><u>Retrieval</u></h5></div>
							<div class='col-2'><h5><u>Price</u></h5></div>
						</div>
		";
		
		$sql2 =	"SELECT       	 ORDER_TOOL.orderID, DELIVERY.scheduledDelivery, DELIVERY.scheduledRetrieval, PRICE_VERSION.pricePerHour, SKU.toolName
				FROM            ORDER_TOOL INNER JOIN
								PRICE_VERSION ON ORDER_TOOL.priceVersionID = PRICE_VERSION.priceVersionID INNER JOIN
								TOOL ON ORDER_TOOL.toolID = TOOL.toolID INNER JOIN SKU ON TOOL.SKU = SKU.SKU INNER JOIN
								DELIVERY ON ORDER_TOOL.deliveryID = DELIVERY.deliveryID
								WHERE ORDER_TOOL.orderID = ". $row['orderID'] .";";
		
		$result2 = $conn->query($sql2);
		$total = 0;
		if ($result2->num_rows > 0) {
			while ($row2 = $result2-> fetch_assoc()) {
				$hour = abs(strtotime($row2['scheduledRetrieval']) - strtotime($row2['scheduledDelivery']))/(60*60);
				$price = round(($row2['pricePerHour'] * $hour), 2);
				$subtotal = $total + $price;
				echo "

						<div class='row'>
							<div class='col-3'>". $row2['toolName'] ."</div>
							<div class='col-3'>". substr($row2['scheduledDelivery'], 0, 16) ."</div>
							<div class='col-3'>". substr($row2['scheduledRetrieval'], 0, 16) ."</div>
							<div class='col-2'>$". $price ."</div>
						</div>
				";
			}
		}
		$total = round(($subtotal * 1.13), 2);
		echo "
			<br>
			<div class='row'>
				<div class='col-8'></div>
				<div class='col-1'>SUBTOTAL</div>
				<div class='col-2'>$".$subtotal."</div>
			</div>
			<div class='row'>
				<div class='col-8'></div>
				<div class='col-1'><b>&nbsp&nbsp&nbsp&nbsp&nbspTOTAL</b></div>
				<div class='col-2'><b>$".$total."</b></div>
			</div>
		</div></td></tr>";
		
		$i++;	
	}
	echo "</tbody></table>";
}
else {
	echo "</tbody></table><br><div style='font-size: 1.3rem;'>No orders. Click on 'Create Order' to get started.</div>";
}