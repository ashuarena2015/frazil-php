<?php
	
	include('config.php');

	$data = array();
  $_POST = json_decode(file_get_contents("php://input"),true);

  $userId = $_POST['user_id'];
  $projectId = $_POST['project_id'];
  $assignedBy = $_POST['assigned_by'];
  $checklistResult = $_POST['checklistResult'];
  $projectPhotos = $_POST['project_photos'];
  $assignedProjectId = $_POST['assigned_project_id'];
  $remarks = $_POST['remarks'];

  $checkSql = mysql_query("select id from users where id='".$userId."'");
  $checkRes = mysql_num_rows($checkSql);

  if($checkRes){
    for($i=0; $i < count($checklistResult); $i++) {
      // echo "insert into project_report(project_id, user_id, assigned_by, checklist_id, checklist_status, remarks, submit_date)
      // values('".$projectId."', '".$userId."', '".$assignedBy."', '".$checklistResult[$i]['id']."', '".$checklistResult[$i]['checked']."', '".$remarks."', '".date('Y-m-d')."')";
      $sql = mysql_query("insert into project_report(project_id, assigned_project_id, user_id, assigned_by, checklist_id, checklist_status, remarks, submit_date)
        values('".$projectId."', '".$assignedProjectId."', '".$userId."', '".$assignedBy."', '".$checklistResult[$i]['id']."', '".$checklistResult[$i]['checked']."', '".$remarks."', '".date('Y-m-d')."')");
      $insertId = mysql_insert_id();
    }
    if($insertId > 0){
      $sql = mysql_query("update assign_project set completed_date='".date('Y-m-d')."' where project_id=".$projectId."");
      // upload photos
      for($i=0; $i < count($projectPhotos); $i++) {
        $img = $projectPhotos[$i]['imageCorpperPath'];
        define('UPLOAD_DIR', 'projectPhotos/');
    
        $format = explode('base64',$img);
        $format = $format[0];
        $extention = explode('data:image/',$format);
        $extention = explode(';',$extention[1]);
    
    
        if($format == 'data:image/jpeg;'){
          $getBaseFormat = str_replace('data:image/jpeg;base64,', '', $img);
        }
        else if($format == 'data:image/png;'){
          $getBaseFormat = str_replace('data:image/png;base64,', '', $img);
        }
        else if($format == 'data:image/gif;'){
          $getBaseFormat = str_replace('data:image/gif;base64,', '', $img);
        }
        else if($format == 'data:image/jpg;'){
          $getBaseFormat = str_replace('data:image/jpg;base64,', '', $img);
        }
        else {
          //echo "Image format is not correct!";
        }
    
        if($getBaseFormat){
          $img = str_replace(' ', '+', $getBaseFormat);
          $data = base64_decode($img);
          $file = UPLOAD_DIR . $userID."_".uniqid() . '.png';
          $success = file_put_contents($file, $data);
          $photosMsg = $success ? $file : '';
        }
        if($photosMsg) {
          mysql_query("insert into report_photos(project_id, user_id, photos, submit_date) values('".$projectId."', '".$userId."', '".$file."', '".date('Y-m-d')."')");
        }
      }
      $msg->success = 1;
    }
  }
  else {
    $msg->error = 0;
  }

	echo json_encode($msg);

?>