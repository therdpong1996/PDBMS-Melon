<?php
    date_default_timezone_set("Asia/Bangkok");
    
    $dsn = 'mysql:host=localhost;dbname=;charset=utf8';
    $username = '';
    $password = '';

    try{
        $con = new PDO($dsn, $username, $password);
    }catch (Exception $ex){
        $ex->getMessage();
    }

    $init['url'] = '';

    $init['upload_password'] = '';

    $firebase['databaseURL'] = '';

    $camera['width'] = '512';
    $camera['height'] = '512';
    $camera['quality'] = '80';

    function ago($time){
       $periods = array("วินาที", "นาที", "ชั่วโมง", "วัน", "สัปดาห์", "เดือน", "ปี", "ทศวรรษ");
       $lengths = array("60","60","24","7","4.35","12","10");

       $now = time();

           $difference     = $now - $time;
           $tense         = "ago";

       for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
           $difference /= $lengths[$j];
       }

       $difference = round($difference);

       return "$difference $periods[$j]";
    }
