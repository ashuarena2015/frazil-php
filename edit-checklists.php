<?php
	
	include('config.php');

	$data = array();
  $_POST = json_decode(file_get_contents("php://input"),true);

	$checkSql = mysql_query("select id from users where id='".$_POST['userId']."'");
  $checkRes = mysql_num_rows($checkSql);
  
  $checkLists = $_POST['checklists'];

	if($checkRes) {
    mysql_query("delete from checklists where project_id=".$_POST['project']."");
    for($i=0; $i < count($checkLists); $i++) {
      $sql = mysql_query("insert into checklists(user_id,project_id,checklist) values('".$_POST['userId']."','".$_POST['project']."','".$checkLists[$i]['text']."')");
    }
    $msg->success = 1;
	} else {
		$msg->error = 0;
	}

	 echo json_encode($msg);

?>