
<?php


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


$username="";
$email = "";
$password = "";


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


$username = mysqli_real_escape_string($conn, trim($request->username));
$email = mysqli_real_escape_string($conn, trim($request->email));
$password = mysqli_real_escape_string($conn, trim($request->password));


$query = "
  INSERT INTO user(`username`, `email`, `password`) 
  VALUES('{$name}','{$email}', '{$password}')";


  if(mysqli_query($conn , $query)){
    echo "Records added successfully.";
  } else{
 echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
}
}

 mysqli_close($conn);
 ?>