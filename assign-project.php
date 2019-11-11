<?php
	
	include('config.php');

	$data = array();
  $_POST = json_decode(file_get_contents("php://input"),true);

  // print_r($_POST);
  // echo "select id from users where id='".$_POST['assigned_by']."'";
	$checkSql = mysql_query("select id from users where id='".$_POST['assigned_by']."'");
  $checkRes = mysql_num_rows($checkSql);  
  // echo $checkRes;
	if($checkRes) { 
    $sql = mysql_query("insert into assign_project(project_id, user_id, assigned_by, assigned_date, completed_date) values('".$_POST['project_id']."', '".$_POST['user_id']."', '".$_POST['assigned_by']."', '".date('Y-m-d')."', '')");
		$insertId = mysql_insert_id();
    if($insertId > 0){
    	$msg->success = 1;
    }
	} else {
		$msg->error = 0;
	}

	 echo json_encode($msg);

?>