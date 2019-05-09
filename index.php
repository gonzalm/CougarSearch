<?php
	session_start();
?>
<!doctype html>

<html lang="en">
<head>

	<?php
	$host="127.0.0.1";
	$port=3306;
	$socket="";
	$user="root";
	$password="cougarsearch";
	$dbname="cougar_search";

	$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());
	// Logic to determine if the navbar should display the logged in user/admin/mod's name, or if there is no one logged in, use the create account/login link in the navbar, logic present on all pages with navbar
	if(isset($_SESSION["admin"])) {
		$accountTab = "<a class='nav-link' href='myaccount.php'>".$_SESSION["admin"]."</a>";
		$logout = "<a class='nav-link' href='index.php?logout=TRUE'>Logout</a>";
	} else if(isset($_SESSION["moderator"])) {
		$accountTab = "<a class='nav-link' href='myaccount.php'>".$_SESSION["moderator"]."</a>";
		$logout = "<a class='nav-link' href='index.php?logout=TRUE'>Logout</a>";
	} else if(isset($_SESSION["username"])) {
		$accountTab = "<a class='nav-link' href='myaccount.php'>".$_SESSION["username"]."</a>";
		$logout = "<a class='nav-link' href='index.php?logout=TRUE'>Logout</a>";
	}
	else {
		$accountTab = "<a class='nav-link' href='login.php'>Login/Create Account</a>";
		$logout = "";
	}
	// Logout logic, checks if user clicked "logout" and if they did, destroys the session and unsets any session variables
	if(isset($_GET["logout"])) {
		session_unset();
		session_destroy();
		header("Location:index.php");
	}
	?>
  <meta charset="utf-8">

  <title>Cougar Search</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="res/css/style.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light"> <!-- Start of the navbar present on every page (except login and signup) -->
  <a class="navbar-brand" href="index.php">Cougar Search</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="browse.php" >Browse</a>
      </li>
      <li>
      	<a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item">
      	<?php echo $accountTab; ?>
      </li>
      <li>
      	<?php echo $logout; ?>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="results.php" method="get">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav> <!-- End of navbar, present on every page -->


<h2 style="text-align:center;">Cougar Search</h2>
<p style ="text-align:center;">Featured dogs of the week</p>

<div class="slideshow-container">

	<?php
	$sql = "SELECT * FROM dog_listings LIMIT 3";
	$result = $con->query($sql);
	$fName = "Muneka";
	// Checks if there are results, then goes through each result and creates a slide in the slide show with that dog's information (ID, name, and picture)
	if($result->num_rows > 0) {
		$counter = 0;
		while ($row = $result->fetch_assoc()) {
			$fName = $row["dogName"];
			$listingID = $row["listingID"];
			$picpath = $row["picture"];
			$counter++;
			echo '

				<div class="mySlides fade">
  					<a href="dogProfile.php?listingID='.$listingID.'">
  					<div class="numbertext">'.$counter.' / 3</div>
 				 	<img src="res/images/'.$picpath.'" style="width:100%">
  					<div class="text">'.$fName.'</div>
 	 				</a>
				</div>
			';

		}
	}
	?>

</div>
<br>

<div style="text-align:center">
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
</div>
<!-- Logic for slideshow functionality  -->
<script>
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}
</script>
</div>


	<!-- Bootstrap scripts -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
