<?php
	session_start();
?>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
  <a  href="home.php">
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
        <a class="nav-link nav-links" href="#">Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link nav-links" href="#">Create Order</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link nav-links" href="#">Business Information</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link nav-links" href="#">Profile</a>
      </li>
    </ul>
	
	<?php
		if (isset($_SESSION["firstName"])) {
			echo '<a class="btn btn-secondary" type="button" href="includes/logout.inc.php" style="padding: 0.4rem 3rem !important;">Logout</a>';
		}
		else {
			header("location: index.php?error=timeout");
			exit();
		}
	?>
	

  </div>
</nav>