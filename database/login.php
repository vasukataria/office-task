<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include_once("mydb.php");

$uName = "";
$pass = "";


$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
    $request = json_decode($postdata);
    $uName = mysqli_real_escape_string($conn,trim($request->uName));
    $pass = mysqli_real_escape_string($conn,trim($request->pass));
    $pass = md5($pass);

    $sql = "SELECT uName,pass FROM user 
            WHERE uName = '{$uName}' AND pass = '{$pass}'";

    $result = mysqli_query($conn, $sql);  
    $row    = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $count  = mysqli_num_rows($result);  
          
    if($count == 1){
        
        if($row['uName'] == 'Admin'){
        $myObj = new stdClass;;  
        $myObj->message = " Admin Login successful";
        $myObj->user    =  "Admin";
        $myObj->token = md5(date('Y-m-d h:i:s'));
        

        $myJSON = json_encode($myObj);
        setcookie("data", $myJSON, time()+ 60*60*60,'/');
         echo $myJSON; 

         }
         else{
    
        $myObj = new stdClass;;  
        $myObj->message = "Login successful";
        $myObj->user    =  "user";
        $myObj->username= "uname";
        $myObj->token = md5(date('Y-m-d h:i:s'));
        $myJSON = json_encode($myObj);
        setcookie("data", $myJSON, time()+ 60*60*60,'/');
         echo $myJSON;
         } 
               
    }  
    else{  
        
        header('HTTP/1.0 401 Unauthorized');
        die ("Not authorized");         
    }             

}

$conn->close();


?>
