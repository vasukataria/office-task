<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

session_start();
include_once("mydb.php");
$name="";																	
$email = "";
$message = "";
$subject = "";
$policies = [];
$out = array('error' => false);

$crud = 'read';

if(isset($_GET['crud'])){
  $crud = $_GET['crud'];
}
//$postdata = file_get_contents("php://input");



  if($crud == 'read'){
  $sql = "SELECT * FROM `videos`";
  $query = $conn->query($sql);
  //print_r($query);
  $videos = array();

  if($result = mysqli_query($conn,$sql))
  {
    $i = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $policies[$i]['id']      = $row['id'];
    $policies[$i]['name']    = $row['name'];
    $policies[$i]['email']   = $row['email'];
    $policies[$i]['subject'] = $row['subject'];
    $policies[$i]['message'] = $row['message'];
    $i++;
  }
  
  echo json_encode($policies);
  
}
  $out['videos'] = $videos;

}


if($crud == 'create'){


$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))

{

$request = json_decode($postdata);


$name = mysqli_real_escape_string($conn, trim($request->name));
$email = mysqli_real_escape_string($conn, trim($request->email));
$subject = mysqli_real_escape_string($conn, trim($request->subject));
$message = mysqli_real_escape_string($conn, trim($request->message));




$query = "
            INSERT INTO `videos` (`name`, `email`, `subject`,`message`) 
            VALUES('{$name}','{$email}', '{$subject}', '{$message}')";



  if(mysqli_query($conn , $query)){
    echo "Records added successfully.";
  } else{
         echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
    }
}
}

if($crud == 'update'){
$id = mysqli_real_escape_string($conn, $_POST['id']);
$name = mysqli_real_escape_string($conn, $_POST['name']);
$email  = mysqli_real_escape_string($conn, $_POST['email']);
$subject  = mysqli_real_escape_string($conn, $_POST['subject']);
$message  = mysqli_real_escape_string($conn, $_POST['message']);

$query = "UPDATE `videos` SET `name`='$name',`email`='$email', `subject`='$subject', `message`='$message' WHERE `id` = '$id' ";

if(mysqli_query($conn , $query)){
    echo "Records edited successfully.";
 }else{
         echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
      }

  
  
}

if($crud == 'delete'){

  $id = mysqli_real_escape_string($conn, $_POST['id']);

  $sql = $conn->prepare("DELETE FROM `videos` WHERE id=?");
  $sql->bind_param("s", $id);
  $sql->execute();

  

  if(mysqli_query($conn , $sql)){
    $out['message'] = "Member Deleted Successfully";
  }
  else{
    $out['error'] = true;
    $out['message'] = "Could not delete Member";
  }
  
}





 mysqli_close($conn);
 ?>