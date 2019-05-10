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
  <nav class="navbar navbar-expand-lg navbar-light bg-light"><!-- Start of the navbar present on every page (except login and signup) -->
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
</nav> <!-- end of navbar-->
<body>

    <?php 
    // checks if name was submitted (name is the first field, in reality it doesn't matter which field it checks as all are)
    if(isset($_POST['name'])) {
        // Query to insert new dog into database table
        $sql = "INSERT INTO dog_listings(dogName, gender, breed, age, datePosted, userID, dogDesc)

        VALUES ('".$_POST['name']."', '".$_POST['sex']."', '".$_POST['breed']."', ".$_POST['age'].", CURDATE(), ".$_SESSION['userID'].", 'Name: ".$_POST['name']." Age: ".$_POST['age']." Breed: ".$_POST['breed']." Gender: ".$_POST['sex']."');";

        if ($con->query($sql) === TRUE) {

        } else {

        echo "Error: " . $sql . "<br>" . $con->error;

        }

    }
    ?>
    <!-- Form for submitting new dog -->
    <form  method="POST" action='#'>
    <div align="center">
            <h1>Upload the dog file here:</h1>
            <p>Please fill in this form to upload a dog file.</p>
            <hr>
          
            <label for="name"><b>Name</b></label>
            <input type="name" placeholder="Enter Name" name="name" required>
          
            <label for="breed"><b>Breed</b></label>
            <input type="breed" placeholder="Enter Breed" name="breed" required>
          
            <label for="sex"><b>Sex</b></label>
            <input type="sex" placeholder="Enter Sex" name="sex" required>
          
            <label for="age"><b>Age</b></label>
            <input type="age" placeholder="Age" name="age" required>
            <div class="submit">
                <input type="submit" name="submit" value="submit" onclick="javascrtpt:window.location.href='uploadDog.php'">
            </div>
            <div class="clear">
            <input type="button" value="Cancel" onclick="javascrtpt:window.location.href='uploadDog.php'">
            </div>
        </div>
    </form>
    </body>
</html>
