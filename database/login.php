<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include_once("mydb.php");

if(isset($_COOKIE["type"]))
{
 echo $myJSON;
}

$username = "";
$password = "";


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
        
        $myObj = new stdClass;;  
        $myObj->message = "Login successful";
        $myObj->token = md5(date('Y-m-d h:i:s'));
        

        $myJSON = json_encode($myObj);
        session_start();
        setcookie("data", $myJSON, time()+ 60*60*60,'/');
         echo $myJSON;   
               
    }  
    else{  
        
        header('HTTP/1.0 401 Unauthorized');
        die ("Not authorized");         
    }             

}

$conn->close();


?>
