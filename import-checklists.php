<?php

  include('config.php');

  $_POST = json_decode(file_get_contents("php://input"),true);

    $userId = $_POST['user_id'];
    $projectId = $_POST['project_id'];
    $checkListJson = $_POST['checklistFile'];

    $check = mysql_query("select * from users where id=".$userId."");
    $rows = mysql_num_rows($check);

    if($rows) {
      $affectedRows = 0;
      foreach ($checkListJson as $key => $value) {	
        $checkList = $value[0];
        $sql = mysql_query("insert into checklists(`project_id`,`checklist`,`user_id`) values('".$projectId."','".$checkList."', '".$userId."')");
        $insertId = mysql_insert_id();
        $affectedRows ++;
      }
      $msg->success = 1;
    } else {
      $msg->error = 0;
    }
    echo json_encode($msg);
?>