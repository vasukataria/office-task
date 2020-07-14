<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");



include_once("mydb.php");

$title="";                                 
$desc = "";
$class ="";
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
  $sql = "SELECT * FROM `service`";
  $query = $conn->query($sql);
  //print_r($query);
  $service = array();

  if($result = mysqli_query($conn,$sql))
  {
    $i = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $policies[$i]['id']           = $row['id'];
    $policies[$i]['title']        = $row['title'];
    $policies[$i]['desc']         = $row['desc'];
    $policies[$i]['class']   = $row['class'];
    $i++;
  }
  
  echo json_encode($policies);
  
}
  $out['service'] = $service;

}


if($crud == 'create'){


$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))

{

$request = json_decode($postdata);


$title      = mysqli_real_escape_string($conn, trim($request->title));
$desc       = mysqli_real_escape_string($conn, trim($request->desc));
$class = mysqli_real_escape_string($conn, trim($request->class));





$query = "
            INSERT INTO `service` (`title`, `desc` `class`) 
            VALUES('{$title}','{$desc}''{$class}')";



  if(mysqli_query($conn , $query)){
    echo "Records added successfully.";
  } else{
         echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
    }
}
}

if($crud == 'update'){
$id = mysqli_real_escape_string($conn, $_POST['id']);
$title = mysqli_real_escape_string($conn, $_POST['title']);
$desc  = mysqli_real_escape_string($conn, $_POST['desc']) ;
$class  = mysqli_real_escape_string($conn, $_POST['class']);



$query = "UPDATE `service` SET `title`='$title',`desc`='$desc', `class`='$class'  WHERE `id` = '$id' ";

if(mysqli_query($conn , $query)){
    echo "Records edited successfully.";
 }else{
         echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
      }

  
  
}

if($crud == 'delete'){

  $id = mysqli_real_escape_string($conn, $_POST['id']);

  $sql = $conn->prepare("DELETE FROM `service` WHERE id=?");
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
