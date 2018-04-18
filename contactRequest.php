<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  
<div>
    <a href ="index.html">Back Home</a>
</div>
<h2>Famous Quotes</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Quote: <input type="text" name="quote" value="">
  <span class="error">* <?php echo $quoteErr;?></span>
  <br><br>
  Source: <input type="text" name="source" value="">
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

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
$quote = $source = "";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["quote"])) {
    $quoteErr = "Quote is required";
  } else {
    $quote = test_input($_POST["quote"]);
    // check if name only contains letters and whitespace
  }

  if (empty($_POST["source"])) {
    $source = "";
  } else {
    $source = test_input($_POST["source"]);
  }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$sql = "";
if(!empty($quote) && !empty($source))
{
    $sql = "INSERT INTO criahi (quote, source) VALUES ( \"" . $quote . "\", \"" . $source ."\");";
    
    mysqli_query($conn, $sql);
}

echo "<h2>Past Quotes:</h2>";

$sql="SELECT * FROM criahi";

if ($result=mysqli_query($conn,$sql))
  {
  // Fetch one and one row
  while ($row=mysqli_fetch_row($result))
    {
    echo $row[0] . " - " . $row[1];
    echo "<br><br>";
    }
  // Free result set
  mysqli_free_result($result);
}


$conn->close();
?>

</body>
</html>


