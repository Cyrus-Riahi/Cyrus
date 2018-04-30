<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  


<?php

$servername = "localhost";
$username = "csc412";
$password = "csc412";

// Create connection
$conn = mysqli_connect($servername, $username, $password, 'csc412');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

// define variables and set to empty values
$quoteErr = "";
$name = $email = $subject ="";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST['name'])) {
    $quoteErr = "Name is required";
  } else {
    $name = test_input($_POST['name']);
    // check if name only contains letters and whitespace
  }

  if (empty($_POST['email'])) {
    $email = "";
  } else {
    $email = test_input($_POST['email']);
  }
  
  if (empty($_POST['message'])) {
    $message = "";
  } else {
    $message = test_input($_POST['message']);
  }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$sql = "";
if(!empty($name) && !empty($email) && !empty($message))
{
    $sql = "INSERT INTO criahi (name, email, message) VALUES ( \"" . $name . "\", \"" . $email . "\", \"" . $message . "\");";
    
    mysqli_query($conn, $sql);
}

$conn->close();
header('Location: index2.html#Contact');
?>


</body>
</html>
