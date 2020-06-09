
<?php


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


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
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{

$request = json_decode($postdata);


$name = mysqli_real_escape_string($conn, trim($request->name));
$email = mysqli_real_escape_string($conn, trim($request->email));
$subject = mysqli_real_escape_string($conn, trim($request->subject));
$message = mysqli_real_escape_string($conn, trim($request->message));


$query = "
  INSERT INTO `videos`(`name`, `email`, `subject`,`message`) 
  VALUES('{$name}','{$email}', '{$subject}', '{$message}')";


  if(mysqli_query($conn , $query)){
    echo "Records added successfully.";
  } else{
 echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
}
}

 mysqli_close($conn);
 ?>