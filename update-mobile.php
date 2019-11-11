<?php
	include('config.php');

		$_POST = json_decode(file_get_contents("php://input"),true);
		// print_r($_POST);
		$userID = $_POST['userId'];
		$newMobile = $_POST['mobile'];
		$otp = $_POST['otp'];
		// echo "update users set mobile='".$newMobile."' where id=".$userID." and mobile_verify_otp=".$otp."";
		$sql = mysql_query("update users set mobile='".$newMobile."' where id=".$userID." and mobile_verify_otp=".$otp."");
		$updateRow = mysql_affected_rows();

		if($updateRow > 0) {
			echo json_encode(array('status' => 1));
		}else {
			echo json_encode(array('status' => 0));
		}	

?>