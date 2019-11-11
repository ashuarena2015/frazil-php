<?php
	
	include('config.php');
	$_POST = json_decode(file_get_contents("php://input"),true);
  $sql = mysql_query("select * from users");
  $getId = mysql_num_rows($sql);
  $data = array();

  if($getId > 0){
    
    while($row = mysql_fetch_array($sql)){
      $data[] = $row;
    }

  }else {
    $data[] = 0;
  }	

  echo json_encode($data, JSON_NUMERIC_CHECK);	
?>