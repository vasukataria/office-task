<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header ("Content-type: image/jpg");


session_start();
include_once("mydb.php");


$title="";                                 
$desc = "";
$img   ="";
$facebookLink ="";
$twitterLink ="";
$googleLink ="";
$linkedinLink ="";
$policies = [];

$out = array('error' => false);

$crud = 'read';

if(isset($_GET['crud'])){
  $crud = $_GET['crud'];
}
//$postdata = file_get_contents("php://input");



  if($crud == 'read'){
  $sql = "SELECT * FROM `team`";
  $query = $conn->query($sql);
  //print_r($query);
  $team = array();

  if($result = mysqli_query($conn,$sql))
  {
    $i = 0;
  while($row = mysqli_fetch_array($result))
  {
    $policies[$i]['id']                    = $row['id'];
    $policies[$i]['title']                 = $row['title'];
    $policies[$i]['desc']                  = $row['desc'];
    $policies[$i]['linkedinLink']          = $row['linkedinLink'];
    $policies[$i]['facebookLink']          = $row['facebookLink'];
    $policies[$i]['twitterLink']           = $row['twitterLink'];
    $policies[$i]['googleLink']            = $row['googleLink'];
    $policies[$i]['img']          =  base64_encode($row['img']);
    $i++;
  }
  
  echo json_encode($policies);
  
}

  $out['team'] = $team;

}
if($crud == 'create'){


$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))

{

$request = json_decode($postdata);


$img         = mysqli_real_escape_string($conn, trim($request->img));
$title       = mysqli_real_escape_string($conn, trim($request->title));
$desc        = mysqli_real_escape_string($conn, trim($request->desc));
$facebookLink        = mysqli_real_escape_string($conn, trim($request->desc));
$twitterLink        = mysqli_real_escape_string($conn, trim($request->desc));
$googleLink        = mysqli_real_escape_string($conn, trim($request->desc));
$linkedinLink        = mysqli_real_escape_string($conn, trim($request->desc));




$query = "
            INSERT INTO `team` ( `title`, `desc`, `img`, `facebookLink`, `twitterLink`, `googleLink`, `linkedinLink`) 
            VALUES('{$title}','{$desc}','{$img}','{$facebookLink}','{$twitterLink}','{$googleLink}','{$linkedinLink}')";



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
$facebookLink  = mysqli_real_escape_string($conn, $_POST['facebookLink']);
$twitterLink  = mysqli_real_escape_string($conn, $_POST['twitterLink']);
$googleLink  = mysqli_real_escape_string($conn, $_POST['googleLink']);
$linkedinLink  = mysqli_real_escape_string($conn, $_POST['linkedinLink']);


$query = "UPDATE `team` SET `img`='$img',`desc`='$desc',`facebookLink`='$facebookLink',`twitterLink`='$twitterLink',`googleLink`='$googleLink',`linkedinLink`='$linkedinLink'  WHERE `id` = '$id' ";

if(mysqli_query($conn , $query)){
    echo "Records edited successfully.";
 }else{
         echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
      }

  
  
}

if($crud == 'delete'){

  $id = mysqli_real_escape_string($conn, $_POST['id']);

  $sql = $conn->prepare("DELETE FROM `team` WHERE id=?");
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
