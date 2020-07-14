<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


include_once("mydb.php");
$title="";                                 
$desc = "";
$Clients ="";
$Projects ="";
$HoursOfSupport ="";
$HardWorkers ="";
$policies = [];
$out = array('error' => false);

$crud = 'read';

if(isset($_GET['crud'])){
  $crud = $_GET['crud'];
}
//$postdata = file_get_contents("php://input");



  if($crud == 'read'){
  $sql = "SELECT * FROM `Facts`";
  $query = $conn->query($sql);
  //print_r($query);
  $Facts = array();

  if($result = mysqli_query($conn,$sql))
  {
    $i = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $policies[$i]['id']               = $row['id'];
    $policies[$i]['title']            = $row['title'];
    $policies[$i]['desc']             = $row['desc'];
    $policies[$i]['Clients']          = $row['Clients'];
    $policies[$i]['Projects']         = $row['Projects'];
    $policies[$i]['HoursOfSupport']   = $row['HoursOfSupport'];
    $policies[$i]['HardWorkers']      = $row['HardWorkers'];
    $i++;
  }
  
  echo json_encode($policies);
  
}
  $out['Facts'] = $Facts;

}


if($crud == 'create'){


$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))

{

$request = json_decode($postdata);


$title          = mysqli_real_escape_string($conn, trim($request->title));
$desc           = mysqli_real_escape_string($conn, trim($request->desc));
$Clients        = mysqli_real_escape_string($conn, trim($request->Clients));
$Projects       = mysqli_real_escape_string($conn, trim($request->Projects));
$HoursOfSupport = mysqli_real_escape_string($conn, trim($request->HoursOfSupport));
$HardWorkers    = mysqli_real_escape_string($conn, trim($request->HardWorkers));





$query = "
            INSERT INTO `Facts` (`title`, `desc`,`Clients`,`Projects`,`HoursOfSupport`,`HardWorkers`) 
            VALUES('{$title}','{$desc}','{$Clients}','{$Projects}','{$HoursOfSupport}','{$HardWorkers}')";



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
$Clients  = mysqli_real_escape_string($conn, $_POST['Clients']);
$Projects  = mysqli_real_escape_string($conn, $_POST['Projects']);
$HoursOfSupport  = mysqli_real_escape_string($conn, $_POST['HoursOfSupport']);
$HardWorkers  = mysqli_real_escape_string($conn, $_POST['HardWorkers']);



$query = "UPDATE `Facts` SET `title`='$title',`desc`='$desc', `Clients`='$Clients' , `Projects`='$Projects' , `HoursOfSupport`='$HoursOfSupport' , `HardWorkers`='$HardWorkers'  WHERE `id` = '$id' ";

if(mysqli_query($conn , $query)){
    echo "Records edited successfully.";
 }else{
         echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
      }

  
  
}

if($crud == 'delete'){

  $id = mysqli_real_escape_string($conn, $_POST['id']);

  $sql = $conn->prepare("DELETE FROM `Facts` WHERE id=?");
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
