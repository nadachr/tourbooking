<?php 

include '../condb.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
}else header("Location: ad-all-package.php");

$sql = "UPDATE tbbookingdetail SET isPaidTotal = 2 WHERE bkid = $id";
$sql2 = "SELECT ref_planno FROM tbbookingdetail WHERE bkid = $id";
$result = mysqli_query($con, $sql);
$result2 = mysqli_query($con, $sql2);

foreach($result2 as $row){
    $tourid = $row['ref_planno'];
}

if($result2){
    header("Location: ad-booking.php?id=$tourid");
}else echo "SELECT ref_planno FROM tbbookingdetail WHERE bkid = $id";
?>