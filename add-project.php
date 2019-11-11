<?php
	
	include('config.php');

	$data = array();
  $_POST = json_decode(file_get_contents("php://input"),true);

	$checkSql = mysql_query("select id from users where id='".$_POST['userId']."'");
  $checkRes = mysql_num_rows($checkSql);  

	if($checkRes) { 
    $sql = mysql_query("insert into projects(name) values('".$_POST['project']."')");
		$insertId = mysql_insert_id();
    if($insertId > 0){
    	$msg->success = 1;
    }
	} else {
		$msg->error = 0;
	}

	 echo json_encode($msg);

?>