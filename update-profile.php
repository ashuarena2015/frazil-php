<?php
	
	include('config.php');

		$data = array();

		$_POST = json_decode(file_get_contents("php://input"),true);
    
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $sql = mysql_query("update users set name='".$name."', address='".$address."' where id='".$_POST['id']."'");
    $updateRow = mysql_affected_rows();
    if($updateRow) {
      $sql2 = mysql_query("select * from users where id='".$_POST['id']."'");
      while($row = mysql_fetch_array($sql2)){
        $data[] = $row;
      }
    }

		echo json_encode($data);	
?>