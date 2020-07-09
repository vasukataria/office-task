<?php


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
//header('Content-Type: application/json');

session_start();
include_once("mydb.php");


$uName="";
$email = "";
$pass = "";
 
 //echo 'Connected successfully' ;
//echo json_encode($_POST);
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
$request = json_decode($postdata);


$uName = mysqli_real_escape_string($conn, trim($request->uName));
$email = mysqli_real_escape_string($conn, trim($request->email));
$pass = mysqli_real_escape_string($conn, trim($request->pass));
$pass = md5($pass);
	

    $sql_u = "SELECT * FROM `user` WHERE `uName`='{$uName}'";
  	$sql_e = "SELECT * FROM `user` WHERE `email`='{$email}'";
  	$res_u = mysqli_query($conn, $sql_u);
  	$res_e = mysqli_query($conn, $sql_e);
    //$result =[];
    //$api = $this->api;
  	if (mysqli_num_rows($res_u) > 0) {
  	  $name_error = "Sorry... username already taken";
       //var_dump(http_response_code(400));
       http_response_code(400);	
       echo $name_error;
      //$result=["status"=>'alreadyusername',"message"=>$name_error];
      //echo json_encode($result);

  	}else if(mysqli_num_rows($res_e) > 0){
  	  $email_error = "Sorry... email already taken"; 
      http_response_code(400);
      echo $email_error;
     // $result=["status"=>'alreadyusername',"message"=>$email_error];
      //echo json_encode($result);
      //die();
  	}
  else{
$query = "
  INSERT INTO `user`(`uName`, `email`, `pass`) 
  VALUES('{$uName}','{$email}', '{$pass}')";

  if(mysqli_query($conn , $query)){
    echo "Records added successfully.";
  } else{
 echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
}
}
}

 mysqli_close($conn);
 ?>