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
	$password="";
	$dbname="cougar_search";

	$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

	if(isset($_SESSION["username"])) {
		$accountTab = "<a class='nav-link' href='index.php'>".$_SESSION["username"]."</a>";
		$logout = "<a class='nav-link' href='index.php?logout=TRUE'>Logout</a>";
	}
	else {
		$accountTab = "<a class='nav-link' href='login.php'>Login/Create Account</a>";
		$logout = "";
	}

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
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Cougar Search</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="browse.php" >Browse</a>
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
</nav>
<div class="container">
	
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col p-5">
			<p class="h2 text-center">Featured Dogs</p>
		</div>
	</div>

	<div class="row text-center">
	<?php
	$sql = "SELECT * FROM dog_listings LIMIT 3";
	$result = $con->query($sql);
	$fName = "Muneka";
	$fAge = 2;
	$fBreed = "Mixed";

	if($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$fName = $row["dogName"];
			$fAge = $row["age"];
			$fBreed = $row["breed"];
			$listingID = $row["listingID"];
			$picpath = $row["picture"];
			echo '
	</div>
		<div class="col-md p-5 m-5 ColLimit border border-dark">
			<a href="dogProfile.php?listingID='.$listingID.'" class="dogProfile">
				<img class="img-fluid DogPic mx-auto" src="res/images/'.$picpath.'">
				<p class="ProfileText">Name: '.$fName.'</p>
				<p>Age: '.$fAge.'</p>
				<p>Breed: '.$fBreed.'</p>
			</a>
		</div>';
		}
	}
	?>
</div>



	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
