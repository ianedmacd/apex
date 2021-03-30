<?php
	include_once 'header.php'
?>
<?php
	include_once 'nav.php'
?>
<?php
	require_once 'includes/dbh.inc.php';
	require_once 'includes/functions.inc.php';
?>
<?php
	accountLink($conn);
?>

<div id="home">
	<div class="sidebar">
		<div class="sidebar-head">Welcome back,<br>
			<h3 style="text-align: center;">
				<?php echo $_SESSION["firstName"], "&nbsp", $_SESSION["lastName"]; ?>!
			</h3>
		</div>
		<div class="sidebar-foot mt-auto">
			<a type="button" class="btn btn-dark btn-block" href="home.php">About Apex Tools</a>
			<a type="button" class="btn btn-dark btn-block" href="home.php">Contact Us</a>
		</div>
	</div>
	<div class="orders">
		<div class="tabletag"><u>Open Orders</u></div>
		<div class="tabletag2"><i>*Click on an order to expand the details.</i></div>
		<div class="table-responsive">
			<table class="table table-striped">
				<thead class="thead-dark tablehead">
					<tr>
						<th scope="col">Order #</td>
						<th scope="col">Store</td>
						<th scope="col">Approved By</td>
						<th scope="col">Status</td>
					</tr>
				</thead>
				<tbody class="tablebody">
					<?php require_once 'includes/table.inc.php';?>
			<br>
		</div>
		<div class="tabletag"><u>Complete Orders</u></div>
		<div class="tabletag2"><i>*Click on an order to expand the details.</i></div>
		<table class="table table-striped">
			<thead class="thead-dark tablehead">
				<tr>
					<th scope="col" class="tabletop">Order #</td>
					<th scope="col" class="tabletop">Store</td>
					<th scope="col" class="tabletop">Approved By</td>
					<th scope="col" class="tabletop">Status</td>
				</tr>
			</thead>
			<tbody>
				<?php require_once 'includes/table2.inc.php';?>
	</div>

</div>




<?php
	include_once 'footer.php'
?>