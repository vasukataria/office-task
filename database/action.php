<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


include_once("mydb.php");
$title="";                                 
$desc = "";
$buttonName ="";
$policies = [];
$out = array('error' => false);

$crud = 'read';

if(isset($_GET['crud'])){
  $crud = $_GET['crud'];
}
//$postdata = file_get_contents("php://input");



  if($crud == 'read'){
  $sql = "SELECT * FROM `action`";
  $query = $conn->query($sql);
  //print_r($query);
  $action = array();

  if($result = mysqli_query($conn,$sql))
  {
    $i = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $policies[$i]['id']           = $row['id'];
    $policies[$i]['title']        = $row['title'];
    $policies[$i]['desc']         = $row['desc'];
    $policies[$i]['buttonName']   = $row['buttonName'];
    $i++;
  }
  
  echo json_encode($policies);
  
}
  $out['action'] = $action;

}


if($crud == 'create'){


$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))

{

$request = json_decode($postdata);


$title      = mysqli_real_escape_string($conn, trim($request->title));
$desc       = mysqli_real_escape_string($conn, trim($request->desc));
$buttonName = mysqli_real_escape_string($conn, trim($request->buttonName));





$query = "
            INSERT INTO `action` (`title`, `desc` `buttonName`) 
            VALUES('{$title}','{$desc}''{$buttonName}')";



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
$buttonName  = mysqli_real_escape_string($conn, $_POST['buttonName']);



$query = "UPDATE `action` SET `title`='$title',`desc`='$desc', `buttonName`='$buttonName'  WHERE `id` = '$id' ";

if(mysqli_query($conn , $query)){
    echo "Records edited successfully.";
 }else{
         echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
      }

  
  
}

if($crud == 'delete'){

  $id = mysqli_real_escape_string($conn, $_POST['id']);

  $sql = $conn->prepare("DELETE FROM `action` WHERE id=?");
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
