<?php 
    session_start();
?>
<!DOCTYPE HTML>
<html>
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
    if(isset($_POST['name'])) {
        $sql = "INSERT INTO dog_listings(dogName, gender, breed, age, datePosted, userID, dogDesc)
        VALUES ('".$_POST['name']."', '".$_POST['sex']."', '".$_POST['breed']."', ".$_POST['age'].", CURDATE(), ".$_SESSION['userID'].", 'TEST TEST TEST');";

        if ($con->query($sql) === TRUE) {

        } else {
        echo "Error: " . $sql . "<br>" . $con->error;
        }
    }
$con->close();
?>
<link rel="stylesheet" type="text/css" href="css/normalize.css" >
<link rel="stylesheet" href="css/signUpForm.css" >
<title>Upload your dog!</title>
</head>
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
</html>