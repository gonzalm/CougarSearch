


<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="css/normalize.css" >
<link rel="stylesheet" href="css/signUpForm.css" >
<html>
<form  method="POST" action='user.php'>
<div class="container">
	<div align="center">
  <h1>Sign Up</h1>
  <p>Please fill in this form to create an account.</p>
  <hr>

  <label for="email"><b>Email</b></label>
  <input type="email" placeholder="Enter Email" name="email" required>

  <label for="username"><b>User Name</b></label>
  <input type="username" placeholder="Enter User Name" name="username" required>

  <label for="psw"><b>Password</b></label>
  <input type="psw" placeholder="Enter Password" name="psw" required>

  <label for="psw-repeat"><b>Repeat Password</b></label>
  <input type="password" placeholder="Repeat Password" name="psw-repeat" required>

  <div class="clear">
		<input type="button" value="Cancel" onclick="javascrtpt:window.location.href='user.php'">

  <div class="completeSignUp">
    <form action="db.php">
      <input type="submit" name="submit" value="submit" onclick="javascrtpt:window.location.href='personalFile.html'">
      </form>
    </div>
</div>
</div>
</div>
</form>
</html>
<?php
  $host="127.0.0.1";
  $port=3306;
  $socket="";
  $user="root";
  $password="";
  $dbname="cougar_search";
// create connection
$conn = new mysqli($host, $user, $password, $dbname);
// check connection
if ($conn->connect_error) {
    die("fail to connect: " . $conn->connect_error);
}

$sql = "INSERT INTO users(email, username, password, phonenumber)
VALUES ('$_POST[email]', '$_POST[username]', '$_POST[psw]', 5555555555);";

if ($conn->multi_query($sql) === TRUE) {

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
//  echo "<meta http-equiv='refresh' content='1;url=personalFile.html'>";
$conn->close();
?>
