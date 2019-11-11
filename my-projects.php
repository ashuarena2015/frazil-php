<?php
	
	include('config.php');
	$_POST = json_decode(file_get_contents("php://input"),true);
  $sql = mysql_query("select * from assign_project as ap INNER JOIN projects as pr where ap.user_id=".$_POST['user_id']." and pr.id=ap.project_id");
  $getId = mysql_num_rows($sql);
  $data = array();

  if($getId > 0){
    
    while($row = mysql_fetch_array($sql)){
      $data[] = $row;
    }

  }else {
    $data = 0;
  }	

  echo json_encode($data, JSON_NUMERIC_CHECK);	
?>