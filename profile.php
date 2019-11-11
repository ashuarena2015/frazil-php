<?php
	
	include('config.php');

		$data = array();

		$_POST = json_decode(file_get_contents("php://input"),true);
		
		$sql = mysql_query("select * from users where users.email='".$_POST['email']."'");
		while($row = mysql_fetch_array($sql)){
			$data[] = $row;
		}

		echo json_encode($data, JSON_NUMERIC_CHECK);	
?>