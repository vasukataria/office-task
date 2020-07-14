<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


include_once("mydb.php");
$Copyright="";                                 
$name = "";
$buttonName ="";
$buttonName ="";
$buttonName ="";
$buttonName ="";
$policies = [];
$out = array('error' => false);

$crud = 'read';

if(isset($_GET['crud'])){
  $crud = $_GET['crud'];
}
//$postdata = file_get_contents("php://input");



  if($crud == 'read'){
  $sql = "SELECT * FROM `footer`";
  $query = $conn->query($sql);
  //print_r($query);
  $footer = array();

  if($result = mysqli_query($conn,$sql))
  {
    $i = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $policies[$i]['id']         = $row['id'];
    $policies[$i]['Copyright']  = $row['Copyright'];
    $policies[$i]['name']       = $row['name'];
    $policies[$i]['rights']     = $row['rights'];
    $policies[$i]['workby']     = $row['workby'];
    $policies[$i]['link']       = $row['link'];
    $i++;
  }
  
  echo json_encode($policies);
  
}
  $out['footer'] = $footer;

}


if($crud == 'create'){


$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))

{

$request = json_decode($postdata);


$Copyright          = mysqli_real_escape_string($conn, trim($request->Copyright));
$name           = mysqli_real_escape_string($conn, trim($request->name));
$rights        = mysqli_real_escape_string($conn, trim($request->rights));
$workby       = mysqli_real_escape_string($conn, trim($request->workby));
$link = mysqli_real_escape_string($conn, trim($request->link));





$query = "
            INSERT INTO `footer` (`Copyright`, `name`,`rights`,`workby`,`link`) 
            VALUES('{$Copyright}','{$name}','{$rights}','{$workby}','{$link}')";



  if(mysqli_query($conn , $query)){
    echo "Records added successfully.";
  } else{
         echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
    }
}
}

if($crud == 'update'){
$id = mysqli_real_escape_string($conn, $_POST['id']);
$Copyright = mysqli_real_escape_string($conn, $_POST['Copyright']);
$name  = mysqli_real_escape_string($conn, $_POST['name']) ;
$rights  = mysqli_real_escape_string($conn, $_POST['rights']);
$workby  = mysqli_real_escape_string($conn, $_POST['workby']);
$link  = mysqli_real_escape_string($conn, $_POST['link']);



$query = "UPDATE `footer` SET `Copyright`='$Copyright',`name`='$name', `rights`='$rights' , `workby`='$workby' , `link`='$link' WHERE `id` = '$id' ";

if(mysqli_query($conn , $query)){
    echo "Records edited successfully.";
 }else{
         echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
      }

  
  
}

if($crud == 'delete'){

  $id = mysqli_real_escape_string($conn, $_POST['id']);

  $sql = $conn->prepare("DELETE FROM `footer` WHERE id=?");
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
