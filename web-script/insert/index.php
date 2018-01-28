<?php 

	require '../init.php';
	require 'mysql.class.php';
	require 'firebase.class.php';

	if (!empty($_GET['temp']) and !empty($_GET['humi']) and !empty($_GET['light']) and !empty($_GET['weight']) and !empty($_GET['mosi'])) {

		$mysql = new mysql($con);
		$firebase = new firebase($firebase['databaseURL']);

		//Prepare Data
		$time = time();
		$data = ['temp'=>(float)$_GET['temp'], 'humi'=>(float)$_GET['humi'], 'light'=>(float)$_GET['light'], 'weight'=>(float)$_GET['weight'], 'mosi'=>(float)$_GET['mosi'], 'datetime'=>(int)$time];
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
		if (empty($_GET['temp'])) {
			echo "Missing Temperature<br/>";
		}

		if (empty($_GET['humi'])) {
			echo "Missing Humidity<br/>";
		}

		if (empty($_GET['light'])) {
			echo "Missing Light<br/>";
		}

		if (empty($_GET['weight'])) {
			echo "Missing Weight<br/>";
		}

		if (empty($_GET['mosi'])) {
			echo "Missing Mositure<br/>";
		}
		exit('Insufficient Data');
	}

	function generateIdentity($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
