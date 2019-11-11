<?php
	
	include('config.php');
	
		$data = array();
		$_POST = json_decode(file_get_contents("php://input"),true);

		if(!$_POST['loginByCookie']){
			$sql = mysql_query("select * from users where email='".$_POST['email']."' and password='".$_POST['password']."'");
		}else {
			$sql = mysql_query("select * from users where email='".$_POST['email']."'");
		}
		$getId = mysql_num_rows($sql);
		if($getId > 0){
			$row = mysql_fetch_array($sql);
			$data[] = array('email' => $row['email'], 'user_id' => $row['id'], 'role' => $row['role'] );
	 	}else {
	 		$data[] = array('error' => "Invalid login credential, please try again.");
		 }		

		echo json_encode($data, JSON_NUMERIC_CHECK);	
?>