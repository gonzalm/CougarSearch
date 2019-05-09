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
</nav>

 <div class="col-sm p-5 m-5 ColLimit border border-dark">
  <?php 
  $sql = "SELECT * FROM dog_listings WHERE listingID=". $_GET["listingID"];
  $result = $con->query($sql);
  // Defaults just in case
  $dogName = "Muneka";
  $gender = "Female";
  $breed = "Mixed";
  $age = 3;
  $desc = "she's a good dog";
  $userEmail = "test@test.com";
  $picPath = "muneka.png";
  // Displays all of the dog's information (dog ID retrieved from previous page using $_GET [so from the url i.e. dogProfile.php?listingID=2])
  if($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    $dogName = $data["dogName"];
    $gender = $data["gender"];
    $breed = $data["breed"];
    $age = $data["age"];
    $desc = $data["dogDesc"];
    $picPath = $data["picture"];
    $sql = "SELECT email FROM users WHERE userID=" . $data["userID"];
    $result = $con->query($sql);
    $data = $result->fetch_assoc();
    $userEmail = $data["email"];
  } else {
    echo "Error, no dog selected prior to visiting this page.";
  }
  ?>
        <?php echo ' <img class="img-fluid DogPic mx-auto" src="res/images/'.$picPath.'"'?>>
        <p class="ProfileText">Name: <?php echo $dogName ?></p>
        <p class="ProfileText">Gender: <?php echo $gender ?></p>
        <p class="Breed">Breed: <?php echo $breed ?></p>
        <p class="Age">Age: <?php echo $age ?></p>
        <p class="Description">Description: <?php echo $desc ?></p>
        <p class="OwnerEmail">Owner's email: <?php echo $userEmail ?></p>
    </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>