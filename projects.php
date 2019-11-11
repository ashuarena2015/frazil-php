<?php
	
	include('config.php');

    $_POST = json_decode(file_get_contents("php://input"),true);
    
    $sql = mysql_query("select * from projects");
		$data = array();
    while($row = mysql_fetch_array($sql)){
      $data[] = $row;
    }

		echo json_encode($data);	
?>