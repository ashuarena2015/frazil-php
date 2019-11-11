<?php
	
	include('config.php');

		$data = array();

		$_POST = json_decode(file_get_contents("php://input"),true);
		$sql = mysql_query("select * from assign_project as ap INNER JOIN project_report as pr where pr.assigned_project_id=ap.id  and pr.user_id=".$_POST['user_id']." GROUP BY pr.assigned_project_id");
		while($row = mysql_fetch_array($sql)){
			$data[] = $row;
		}

		echo json_encode($data);	
?>