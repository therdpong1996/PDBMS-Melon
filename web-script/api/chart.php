<?php 
	header('Access-Control-Allow-Origin: *');
	header('Content-type: application/json');

	require_once '../init.php';

	$result['label'] = [];
	$result['temp'] = [];
	$result['humi'] = [];
	$result['light'] = [];
	$result['mosi'] = [];
	$result['weight'] = [];
    $result['lasttime'] = [];
	$stm2 = $con->prepare("SELECT * FROM pdbms_data ORDER BY datetime DESC LIMIT 10");
    $stm2->execute();
    while ($rows = $stm2->fetch(PDO::FETCH_ASSOC)) {
        array_push($result['label'], $rows['datetime']);
        array_push($result['temp'], $rows['temp']);
        array_push($result['humi'], $rows['humi']);
        array_push($result['light'], $rows['mosi']);
        array_push($result['mosi'], $rows['light']);
        array_push($result['weight'], $rows['weight']);
        array_push($result['lasttime'], $rows['datetime']);
    }
    $result['label'] = array_reverse($result['label']);
    $result['temp'] = array_reverse($result['temp']);
    $result['humi'] = array_reverse($result['humi']);
    $result['light'] = array_reverse($result['light']);
    $result['mosi'] = array_reverse($result['mosi']);
    $result['weight'] = array_reverse($result['weight']);
    $result['lasttime'] = $result['lasttime'][0];

    echo json_encode($result);
