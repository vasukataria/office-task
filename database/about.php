<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

session_start();
include_once("mydb.php");

$class="";                                 
$ChildTitle ="";
$ChildDesc ="";
$policies = [];
 
 //echo 'Connected successfully' ;
//echo json_encode($_POST);
$out = array('error' => false);

$crud = 'read';

if(isset($_GET['crud'])){
  $crud = $_GET['crud'];
}
//$postdata = file_get_contents("php://input");



  if($crud == 'read'){
  $sql = "SELECT * FROM `aboutwork`";
  $query = $conn->query($sql);
  //print_r($query);
  $aboutwork = array();

  if($result = mysqli_query($conn,$sql))
  {
    $i = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $policies[$i]['id']                 = $row['id'];
    $policies[$i]['class']              = $row['class'];
    $policies[$i]['ChildTitle']         = $row['ChildTitle'];
    $policies[$i]['ChildDesc']          = $row['ChildDesc'];
    $i++;
  }
  
  echo json_encode($policies);
  
}
  $out['aboutwork'] = $aboutwork;

}


if($crud == 'create'){


$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))

{

$request = json_decode($postdata);


$class      = mysqli_real_escape_string($conn, trim($request->class));
$ChildTitle       = mysqli_real_escape_string($conn, trim($request->ChildTitle));
$ChildDesc        = mysqli_real_escape_string($conn, trim($request->ChildDesc));




$query = "
            INSERT INTO `aboutwork` ( `ChildTitle`, `ChildDesc`, `class`) 
            VALUES('{$ChildTitle}','{$ChildDesc}','{$class}')";



  if(mysqli_query($conn , $query)){
    echo "Records added successfully.";
  } else{
         echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
    }
}
}

if($crud == 'update'){
$id = mysqli_real_escape_string($conn, $_POST['id']);
$class  = mysqli_real_escape_string($conn, $_POST['class']) ;
$ChildTitle  = mysqli_real_escape_string($conn, $_POST['ChildTitle']);
$ChildDesc  = mysqli_real_escape_string($conn, $_POST['ChildDesc']);


$query = "UPDATE `aboutwork` SET `class`='$class',`ChildDesc`='$ChildDesc'  WHERE `id` = '$id' ";

if(mysqli_query($conn , $query)){
    echo "Records edited successfully.";
 }else{
         echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
      }

  
  
}

if($crud == 'delete'){

  $id = mysqli_real_escape_string($conn, $_POST['id']);

  $sql = $conn->prepare("DELETE FROM `aboutwork` WHERE id=?");
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
