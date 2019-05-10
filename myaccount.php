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
  <div class="container-fluid">
  <?php 
  // If a mod was 'removed' (admin clicked remove button), actually remove the mod
  if(isset($_GET["removeMod"])) {
    $sql = "DELETE FROM moderator WHERE username='".$_GET['removeMod']."'";
    if ($con->query($sql) === TRUE) {
      echo "Removal Succesful";
    }
    else {
      // For debugging
      echo "Error deleting moderator ". $_GET['removeMod']. " : ".$con->error;
    }
  }

  // Checks if dog listing was 'removed' (user clicked remove button) and removes said dog.
  if(isset($_GET["removeDog"])) {
    $sql = "DELETE FROM dog_listings WHERE listingID=".$_GET['removeDog']."";
    if ($con->query($sql) === TRUE) {
      echo "Removal Succesful";
    }
    else {
      // For debugging
      echo "Error deleting moderator ". $_GET['removeMod']. " : ".$con->error;
    }
  }

  // If $_POST (method for submitting updated dog info) has the update dog variable set (to the dog's listing id), then check if each field was set, and update in the database accordingly
  if(isset($_POST["updateDog"])) {
    if(isset($_POST["name"])) {
      $sql = "UPDATE dog_listings SET dogName='".$_POST['name']."' WHERE listingID=".$_POST['updateDog'];
      if($con->query($sql)===TRUE) {
        echo "Update Successful";
      } else {
        echo "Update failed: ".$con->error;
      }
    }
    if (isset($_POST["sex"])) {
      $sql = "UPDATE dog_listings SET gender='".$_POST['sex']."' WHERE listingID=".$_POST['updateDog'];
      if($con->query($sql)===TRUE) {
        echo "Update Successful";
      } else {
        echo "Update failed: ".$con->error;
      }
    }
    if (isset($_POST["breed"])) {
      $sql = "UPDATE dog_listings SET breed='".$_POST['breed']."' WHERE listingID=".$_POST['updateDog'];
      if($con->query($sql)===TRUE) {
        echo "Update Successful";
      } else {
        echo "Update failed: ".$con->error;
      }
    }
    if (isset($_POST["age"])) {
      $sql = "UPDATE dog_listings SET age=".$_POST['age']." WHERE listingID=".$_POST['updateDog'];
      if($con->query($sql)===TRUE) {
        echo "Update Successful";
      } else {
        echo "Update failed: ".$con->error;
      }
    }
    header("Location:dogProfile.php?listingID=".$_POST['updateDog']);
  }

  // If user clicked the update dog button, $_GET will have the dog's listing id to pass to the POST method once the user submits the displayed form (displayed using this echo statement below)
  if(isset($_GET["updateDog"])) {
    echo '
    <form  method="POST" action="myaccount.php">
          
            <label for="name"><b>Name</b></label>
            <input type="name" placeholder="Enter Name" name="name" required>
          
            <label for="breed"><b>Breed</b></label>
            <input type="breed" placeholder="Enter Breed" name="breed" required>
          
            <label for="sex"><b>Sex</b></label>
            <input type="sex" placeholder="Enter Sex" name="sex" required>
          
            <label for="age"><b>Age</b></label>
            <input type="age" placeholder="Age" name="age" required>

            <button name="updateDog" type="submit" value="'.$_GET["updateDog"].'">Submit</button>';
    exit();
  }

  // If the session contains an admin logged in, display the admin panel (ability to delete mods and dog listings)
  if (isset($_SESSION["admin"])) {
    echo "<h2>Moderators</h2><br>";
    $query = "SELECT * FROM moderator";
    $result = $con->query($query);
    if ($result->num_rows > 0) {
      echo "<form action='myaccount.php' method='get'>";
      while ($row = $result->fetch_assoc()) {
        echo "Mod: ".$row["username"]." <button name='removeMod' type='submit' value='".$row["username"]."'>REMOVE MOD</button> <br>";
      }
      echo "</form>";
    }
    else {
      echo "No moderators to display";
    }

    echo "<h2>Current Listings</h2>";
    $query = "SELECT * FROM dog_listings";
    $result = $con->query($query);

    if ($result->num_rows >0) {
      echo "<form action='myaccount.php' method='get'>";
      while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["listingID"] . " - Name: " . $row["dogName"] . " - Age: " . $row["age"]. " <button name='removeDog' type='submit' value='".$row["listingID"]."'>REMOVE LISTING</button> <br>";
      }
      echo "</form>";
    } else {
      echo "0 results";
    }
  // If session contains a mod logged in, display mod panel (ability to remove any listing)
  } else if(isset($_SESSION["moderator"])) {

    echo "<h2>Current Listings</h2>";
    $query = "SELECT * FROM dog_listings";
    $result = $con->query($query);

    if ($result->num_rows >0) {
      echo "<form action='myaccount.php' method='get'>";
      while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["listingID"] . " - Name: " . $row["dogName"] . " - Age: " . $row["age"]. " <button name='removeDog' type='submit' value='".$row["listingID"]."'>REMOVE LISTING</button> <br>";
      }
      echo "</form>";
    } else {
      echo "0 results";
    }

  // If it isn't a mod or admin, it's a user, display user panel (remove/update own dogs, create new listing)
  } else {


    echo "<h2>Current Listings</h2>";
    $query = "SELECT * FROM dog_listings WHERE userID=".$_SESSION["userID"];
    $result = $con->query($query);

  if ($result->num_rows >0) {

      echo "<form action='myaccount.php' method='get'>";
    while($row = $result->fetch_assoc()) {
      echo "Name: " . $row["dogName"] . " - Age: " . $row["age"]. " <button name='removeDog' type='submit' value='".$row["listingID"]."'>REMOVE LISTING</button>
      <button name='updateDog' type='submit' value='".$row["listingID"]."'>UPDATE LISTING</button> <br>";
    }
      echo "</form>";
  } else {
    echo "0 results";
  }
  echo "
   <h2>Options</h2>
   <a href='uploadDog.php'>Add a new listing</a>";

}
   ?>

 </div>


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>