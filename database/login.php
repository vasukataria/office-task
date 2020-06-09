<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$username = "";
$password = "";

$database = "mydb";
$username = "root";
$password = "";
 
 // Create connection

 $servername = "localhost";
 $conn = mysqli_connect($servername, $username, $password, $database);

 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
  
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
    $request = json_decode($postdata);
    $username = mysqli_real_escape_string($conn,trim($request->username));
    $password = mysqli_real_escape_string($conn,trim($request->password));

    $sql = "SELECT username,password FROM login 
            WHERE username = '{$username}' AND password = '{$password}'";  
    
    $result = mysqli_query($conn, $sql);  
    $row    = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $count  = mysqli_num_rows($result);  
          
    if($count == 1){  
         echo " Login successful"; 
         
         
    }  
    else{  
        // header('WWW-Authenticate: Basic realm="My Realm"');
        header('HTTP/1.0 401 Unauthorized');
        die ("Not authorized");         
    }             

}

$conn->close();


?>