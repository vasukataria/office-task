<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header ("Content-type: image/jpg");


include_once("mydb.php");

$title="";                                 
$desc = "";
$img   ="";
$policies = [];

//echo json_encode($_POST);
$out = array('error' => false);

$crud = 'read';

if(isset($_GET['crud'])){
  $crud = $_GET['crud'];
}
//$postdata = file_get_contents("php://input");



  if($crud == 'read'){
  $sql = "SELECT * FROM `portfolio`";
  $query = $conn->query($sql);
  //print_r($query);
  $portfolio = array();

  if($result = mysqli_query($conn,$sql))
  {
    $i = 0;
  while($row = mysqli_fetch_array($result))
  {
    $policies[$i]['id']           = $row['id'];
    $policies[$i]['title']        = $row['title'];
    $policies[$i]['desc']         = $row['desc'];
    $policies[$i]['img']          =  base64_encode($row['img']);
    $i++;
  }
  
  echo json_encode($policies);
  
}

  $out['portfolio'] = $portfolio;

}
if($crud == 'create'){


$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))

{

$request = json_decode($postdata);


$img      = mysqli_real_escape_string($conn, trim($request->img));
$title       = mysqli_real_escape_string($conn, trim($request->title));
$desc        = mysqli_real_escape_string($conn, trim($request->desc));




$query = "
            INSERT INTO `portfolio` ( `title`, `desc`, `img`) 
            VALUES('{$title}','{$desc}','{$img}')";



  if(mysqli_query($conn , $query)){
    echo "Records added successfully.";
  } else{
         echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
    }
}
}

if($crud == 'update'){
$id = mysqli_real_escape_string($conn, $_POST['id']);
$img  = mysqli_real_escape_string($conn, $_POST['img']) ;
$title  = mysqli_real_escape_string($conn, $_POST['title']);
$desc  = mysqli_real_escape_string($conn, $_POST['desc']);


$query = "UPDATE `portfolio` SET `img`='$img',`desc`='$desc'  WHERE `id` = '$id' ";

if(mysqli_query($conn , $query)){
    echo "Records edited successfully.";
 }else{
         echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
      }

  
  
}

if($crud == 'delete'){

  $id = mysqli_real_escape_string($conn, $_POST['id']);

  $sql = $conn->prepare("DELETE FROM `portfolio` WHERE id=?");
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
