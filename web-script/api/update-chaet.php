<?php 
	header('Access-Control-Allow-Origin: *');
	header('Content-type: application/json');

	require_once '../init.php';

	$last = $_POST['lasttime'];

	$stm = $con->prepare("SELECT * FROM pdbms_data WHERE datetime > '$last' ORDER BY datetime ASC LIMIT 1");
    try {
        $stm->execute();
    } catch (Exception $e) {
        $e->getMessage();
    }
    $lasted = $stm->fetch(PDO::FETCH_ASSOC);

    if ($lasted) {
		$lasted['r'] = 1;
		echo json_encode($lasted);
	}else{
		$lasted['r'] = 0;
		echo json_encode($lasted);
	}
