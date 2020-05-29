<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

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
 
 echo 'Connected successfully' ;
 echo json_encode($_POST);
 
 mysqli_close($conn);
 
 ?>