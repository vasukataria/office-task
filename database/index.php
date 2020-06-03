
<?php


header("Access-Control-Allow-Origin: *");

$name="";
 $email = "";
 $message = "";
 $subject = "";


 $servername = "localhost";
 $database = "mydb";
 $username = "root";
 $password = "";
 
 // Create connection
 
 $conn = mysqli_connect($servername, $username, $password, $database);
 
 // Check connection
 
 if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
 }
 
 //echo 'Connected successfully' ;
//echo json_encode($_POST);
if(isset($_POST['submit'])){

$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];


$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$subject = mysqli_real_escape_string($conn, $_POST['subject']);
$message = mysqli_real_escape_string($conn, $_POST['message']);
}

$query = "
  INSERT INTO vuetable (`id`, `name`, `email`, `subject`,
        `message`) VALUES ('$name',
        '$email', '$subject', '$message');";


 mysqli_query($conn, $query);

 mysqli_close($conn);
 ?>