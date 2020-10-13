<?php
include_once 'Task.php';
$task = new Task();
$json = array();
 
// create
if(!empty($_POST['action']) && $_POST['action']=="create") {
	$task->setTitle($_POST['title']);
	$task->setStatus(0);
	$status = $task->createTask();
	if(!empty($status)){
		$json['msg'] = 'success';
		$json['task_id'] = $status;
	} else {
		$json['msg'] = 'failed';
		$json['task_id'] = '';
	}
	header('Content-Type: application/json');	
	echo json_encode($json);
}
 
// update
if(!empty($_POST['action']) && $_POST['action']=="update") {
	$task->setTaskID($_POST['task_id']);
	$task->setStatus($_POST['status']);
	$status = $task->updateTask();
	if(!empty($status)){
		$json['msg'] = 'success';
	} else {
		$json['msg'] = 'failed';
	}
	header('Content-Type: application/json');	
	echo json_encode($json);	
}
?>
