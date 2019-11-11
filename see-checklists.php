<?php
	
	include('config.php');

    $_POST = json_decode(file_get_contents("php://input"),true);
    
    $sql = mysql_query("select * from checklists where project_id='".$_POST['project']."'");
		$data = array();
    while($row = mysql_fetch_array($sql)){
      $data[] = $row;
    }

		echo json_encode($data, JSON_NUMERIC_CHECK);	
?>