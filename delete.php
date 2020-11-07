<?php 

session_start();
include 'condb.php';

$iddelete = ($_GET['id']);

if(isset($_GET['id'])){
	
	$delete = "UPDATE `tbbookingdetail` SET planstatus = 0 WHERE `tbbookingdetail`.`bkid` = '$iddelete';";
	$dejQuery = mysqli_query($con, $delete);
	//$objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);
	if(!$dejQuery)
	{
	
	}else{
			header("location:cart-list.php");		
	}
	mysqli_close($con);
}
 ?>