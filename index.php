<?php
	include_once 'header.php'
?>

<div id="index">
	<div class="container">
		<div class="row">
			<div class="title" class="col-sm">
				<h1>Apex</h1>
				<h2>Tool Rentals</h2>
				<div class="row">
					<div class="col-6" style="text-align:centre">
					<button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target=".login_modal">Login</button>
					</div>
					<div class="col-6" style="text-align:centre">
					<a type="button" class="btn btn-warning btn-lg btn-block" style="color: black !important" href="signup.php">Sign Up</a>
					</div>
				</div>
			</div>
			<div class="col-sm">
				<div class="info">
					<h5>Apex provides businesses with low cost tool rental services, while maintaining industry leading quality. Our team of constuction experts and customer service professionals work every day to ensure a perfect customer experience with every order!</h5>
				</div>
			</div>

		</div>
	</div>
	
	<?php
	if (isset($_GET["error"])) {
		if ($_GET["error"] == "wrongemail") {
		echo '<div class="btn btn-danger btn-block">Incorrect Email!</div><br>';
		}
		if ($_GET["error"] == "wrongpassword") {
		echo '<div class="btn btn-danger btn-block">Incorrect Password!</div><br>';
		}
		if ($_GET["error"] == "timeout") {
		echo '<div class="btn btn-danger btn-block">Logged out due to inactivity!</div><br>';
		}
		if ($_GET["error"] == "none") {
		echo '<div class="btn btn-success btn-block">You are signed up!</div><br>';
		}
	}
	?>

</div>
	
	<!--Login Modal-->
	<div class="modal fade login_modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="includes/login.inc.php" method="post">
					<div class="modal-header">
						<h5>Enter your login details</h5>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="email">Email:</label>
							<input type="email"  name= "email" id="email" class="form-control" placeholder="email" required>
						</div>
						<div class="form-group">
							<label for="pwd">Password:</label>
							<input type="password" name="pwd" id="pwd" class="form-control" placeholder="password" required>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<button class="btn btn-primary" type="submit" name="submit">Login</button>
					</div>
				</form>
			</div>
		</div>
	</div>

<?php
	include_once 'footer.php'
?>