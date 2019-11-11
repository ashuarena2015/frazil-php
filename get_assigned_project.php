<?php
	
	include('config.php');
  $_POST = json_decode(file_get_contents("php://input"),true);
  $role = $_POST['role'];
  $email = $_POST['email'];
  $userId = $_POST['userId'];
  if($role === 1) {
    $sql = mysql_query("select * from assign_project where assigned_by=".$userId."");
  } else {
    $sql = mysql_query("select * from assign_project where user_id=".$userId."");
  }
  $getId = mysql_num_rows($sql);
  $data = array();

  if($getId > 0){
    
    while($row = mysql_fetch_array($sql)){
      $data[] = $row;
    }

  }else {
    $data = null;
  }	

  echo json_encode($data, JSON_NUMERIC_CHECK);	
?>