<!DOCTYPE html>
<html>
<head>
	<?php
	  $host="127.0.0.1";
	  $port=3306;
	  $socket="";
	  $user="root";
	  $password="cougarsearch";
	  $dbname="cougar_search";
	  // create connection
	  $conn = new mysqli($host, $user, $password, $dbname);
	  // check connection
	  if ($conn->connect_error) {
	    die("fail to connect: " . $conn->connect_error);
	  }
	  if(isset($_POST["user_name"])) {
	  	$sql = "INSERT INTO users(username, email, password, phonenumber)
	  	VALUES ('".$_POST['user_name']."', '".$_POST['email_address']."', '".$_POST['pass_word']."', '".$_POST['phone_num']."');";
	  	if ($conn->multi_query($sql) === TRUE) {
	  	} else {
	    	echo "Error: " . $sql . "<br>" . $conn->error;
	  	}
	}
	  //  echo "<meta http-equiv='refresh' content='1;url=personalFile.html'>";
	  $conn->close();
	?>
	
	<style type="text/css"></style>
	<title>
		Sign Up Form 
	</title>
	<link rel="stylesheet" type="text/css" href="res/css/style.css">
	<body style="background: url(Dogs.jpg) no-repeat; background-size: 100%;" >
		<div class="signupbox">
			<img src="avi.svg" class="avatar">
				<h1>Sign Up Here</h1>
				<form method="post" action="#">
					<p>Email</p>
					<input type="Email" name="email_address" placeholder="Enter Email" required>
					<p>Username</p>
					<input type="text" name="user_name" placeholder="Enter Username" required>
					<p>Password</p>
					<input type="Password" name="pass_word" placeholder="Enter Password" required="">
					<p>Phone Number</p>
					<input type="Phone" name="phone_num" placeholder="PhoneNumber">
					<input type="submit" href = "login.php" name="" value="Get Started"> <br>

					<a href="#" >Just Want to Browse? Click Here</a><br>
					<a href="#">Already Have an account? Sign IN</a>

				</form>

			<h1></h1>
		</div>
		
	</body>
</head>
	
</html>
