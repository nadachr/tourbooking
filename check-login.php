<?php 

session_start();
include 'condb.php';

$_SESSION['email'] = '';

if(isset($_POST['login'])){
	$email = $_POST['email'];
	$pass = $_POST['pass'];

	$strSQL = "SELECT * FROM tbmember WHERE email = '$email' and password = '$pass'";
	$objQuery = mysqli_query($con, $strSQL);
	$objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);
	if(!$objResult)
	{
		echo "
		<script>
		alert('email หรือ Password ไม่ถูกต้อง');
		window.location = 'login.php';
		</script>";
	}else{
			$_SESSION['email'] = $objResult['email'];
			header("location:index.php");		
	}
	mysqli_close($con);
}
 ?>