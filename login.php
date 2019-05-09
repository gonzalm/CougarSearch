<?php
session_start();
?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
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
  
  // If the user has submitted something, goes through several checks to determine if the entered information is: an admin, a moderator, or a user. If no matches, tell user something is wrong
  if(isset($_POST['username'])){
    $uname=$_POST['username'];
    $pw=$_POST['password'];
    
    $adminCheck = "SELECT * FROM admin WHERE username='".$uname."' AND password='".$pw."' limit 1";

     $result=$con->query($adminCheck);
    
    if($result->num_rows==1) {
      $data = $result->fetch_assoc();
      echo "you have successfully logged in";
      $_SESSION["admin"] = $uname;
      header("Location:index.php");
      exit();
    }

    $modCheck = "SELECT * FROM moderator WHERE username='".$uname."' AND password='".$pw."' limit 1";

    $result=$con->query($modCheck);
    
    if($result->num_rows==1) {
      $data = $result->fetch_assoc();
      echo "you have successfully logged in";
      $_SESSION["moderator"] = $uname;  
      header("Location:index.php");
      exit();
    }

    $sql="select * from users where username='".$uname."'AND password='".$pw."'limit 1";
    
    $result=$con->query($sql);
    
    if($result->num_rows==1) {
      $data = $result->fetch_assoc();
      echo "you have successfully logged in";
      $_SESSION["username"] = $uname;
      $_SESSION["userID"] = $data["userID"];
      header("Location:index.php");
      exit();
    }
    else{
        echo "you have entered incorrect password or username";
    }
  }
 
  ?>   
	<style type="text/css"></style>
	<title>
		Login Form Design
	</title>

        <link rel="stylesheet" type="text/css" href="res/css/style.css">

	<body style="background: url(Dogs.jpg) no-repeat; background-position: center; background-size: 100%;">
		<div class="loginbox">
			<img src="avi.svg" class="avatar">
				<h1>Login Here</h1>
				<form method = "post" action ="#">
					<p>Username</p>
					<input type="text" name="username" placeholder="Enter Username">
					<p>Password</p>
					<input type="Password" name="password" placeholder="Enter Password">
					<input type="submit" href = "index.html" name="login_bttn" value="Login"> <br>
					<a href="signup.php">Don't Have an account? Sign Up</a> <br>
          <a href="browse.php">Just Browsing?</a>

				</form>

			<h1></h1>
		</div>
		
	</body>

</html>