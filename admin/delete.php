<?php 
    
include '../condb.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
}else echo "ERROR!!";

$sql = "UPDATE tbpacktour SET pkstatus = 0 WHERE pktourid = $id";
$result = mysqli_query($con, $sql);

if($result){
    header("Location: ad-all-package.php");
}else echo "error!";

?>