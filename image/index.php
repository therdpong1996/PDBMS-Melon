<?php 
	header('Content-type: application/json;');

	include_once '../init.php';

	if ($_POST['upload_passwd'] != $init['upload_password']) {
		echo json_encode(['code'=>0, 'msg'=>'Password Invalid.']); exit();
	}else{
		$stm = $con->prepare("UPDATE pdbms_picture SET base64pic = :base64pic WHERE identity = :identity");
		$stm->bindParam(':base64pic', $_POST['pre_img']);
		$stm->bindParam(':identity', $_POST['identity']);
		$stm->execute();
		echo json_encode(['code'=>1, 'msg'=>'Uploaded.', 'identity'=>$_POST['identity']]); exit();
	}