<?php 
	header('Access-Control-Allow-Origin: *');
	header('Content-type: application/json');

	require_once '../init.php';
	$stm = $con->prepare("SELECT * FROM pdbms_data JOIN pdbms_picture ON pdbms_data.identity = pdbms_picture.identity ORDER BY pdbms_data.datetime DESC LIMIT 1");
    try {
        $stm->execute();
    } catch (Exception $e) {
        $e->getMessage();
    }
    $lasted = $stm->fetch(PDO::FETCH_ASSOC);

    if (empty($lasted['base64pic'])) {
    	$lasted['base64pic'] = 'https://i.imgur.com/26EU34m.jpg';
    }

    $lasted['ago'] = ago(strtotime($lasted['datetime']));
    $lasted['update'] = date('Y-m-d H:i:s');
    echo json_encode($lasted);
