<?php
	include_once 'header.php'
?>

<nav class="navbar navbar-expand-lg navbar-dark">
  <a  href="index.php">
	<div id="navtitle">
		<span style="font-size: 40px"><b>Apex</b></span>
		<span style="font-size: 30px">&nbspTool Rentals</span>
	</div>
  </a>
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link nav-links" href="index.php">Home<span class="sr-only">(current)</span></a>
      </li>
    </ul>
	<button class="btn btn-secondary" type="button" data-toggle="modal" data-target=".login_modal" style="padding: 0.4rem 3rem !important;">Login</button>
  </div>
</nav>

<div id="signup">
	<div class="signup-form">
		<h2>Sign Up</h2>
		<br>
		
	<?php
	if (isset($_GET["error"])) {
		if ($_GET["error"] == "passwordsdontmatch") {
		echo '<div class="btn btn-danger btn-block">Passwords do not match!</div><br>';
		}
		else if ($_GET["error"] == "stmtfailed") {
		echo '<div class="btn btn-danger btn-block">Something went wrong!</div><br>';
		}
		else if ($_GET["error"] == "emailtaken") {
		echo '<div class="btn btn-danger btn-block">This email is already in use!</div><br>';
		}
	}
	?>

		<form action="includes/signup.inc.php" method="post">
			<div class="form-row">
				<div class="col">
					<label for="firstname">First Name:</label>
					<input type="text" name="firstname" id="firstname" class="form-control" placeholder="firstname" required>
				</div>
				<div class="col">
					<label for="lastname">Last Name:</label>
					<input type="text" name="lastname" id="lastname" class="form-control" placeholder="lastname" required>
				</div>
			</div>
			<br>
			<div class="form-row">
				<div class="col">
					<label for="email">Email:</label>
					<input type="email" name="email" id="email" class="form-control" placeholder="email" required>
				</div>
				<div class="col">
					<label for="phone">Phone Number:</label>
					<input type="text" name="phone" id="phone" class="form-control" placeholder="phone number" required>
				</div>
			</div>
			<br>
			<div class="form-row">
				<div class="col">
					<label for="pwd">Password:</label>
					<input type="password" name="pwd" id="pwd" class="form-control" placeholder="password" required>
				</div>
				<div class="col">
					<label for="pwd2">Repeat Password:</label>
					<input type="password" name="pwd2" id="pwd2" class="form-control" placeholder="repeat password" required>
				</div>
			</div>
			<br>
			<h4>Account Type:</h4>&nbsp&nbsp&nbsp&nbsp&nbsp
			<input type="radio" id="projectManager" name="personType" value="3">
			<label for="projectManager">Project Manager</label>&nbsp&nbsp&nbsp&nbsp&nbsp
			<input type="radio" id="supportStaff" name="personType" value="2">
			<label for="supportStaff">Support Staff</label>
			<br><br>
			<div id="signup_submit">
				<button class="btn btn-primary" style="padding: 0.4rem 3rem !important;" type="submit" name="submit">Sign Up</button>
			</div>
		</form>
	</div>
</div>	

	<!--Login Modal-->
	<div class="modal fade login_modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="includes/login.inc.php" method="post" class="main-form needs-validation">
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
						<button type="submit" class="btn btn-primary" name="submit">Login</button>
					</div>
				</form>
			</div>
		</div>
	</div>


<?php
	include_once 'footer.php'
?>