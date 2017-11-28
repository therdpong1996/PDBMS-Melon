<?php 

	require '../init.php';
	require 'mysql.class.php';
	require 'firebase.class.php';

	if (!empty($_GET['temp']) and !empty($_GET['humi']) and !empty($_GET['light']) and !empty($_GET['weight'])) {

		$mysql = new mysql($con);
		$firebase = new firebase($firebase['databaseURL']);

		//Prepare Data
		$time = time();
		$data = ['temp'=>(float)$_GET['temp'], 'humi'=>(float)$_GET['humi'], 'light'=>(float)$_GET['light'], 'weight'=>(float)$_GET['weight'], 'datetime'=>(int)$time];
		$identity = generateIdentity();

		//Firebase Insert Data
		$firebase->path($identity);
		$firebase->data($data);
		$firebase->execute();

		//MySQL Insert Data
		$mysql->identity($identity);
		$mysql->data($data);
		$mysql->execute();

	}else{
		exit('Insufficient Data');
	}

	function generateIdentity($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}