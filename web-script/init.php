<?php
   
    $dsn = 'mysql:host={{host}};dbname={{dbname}};charset=utf8';
    $username = '{{username}}';
    $password = '{{password}}';

    try{
        $con = new PDO($dsn, $username, $password);
    }catch (Exception $ex){
        $ex->getMessage();
    }

    $init['url'] = '{{wsurl}}';

    $init['upload_password'] = '{{imgpass}}';

    $firebase['databaseURL'] = '{{fburl}}';

    $camera['width'] = '{{imgwidth}}';
    $camera['height'] = '{{imgheight}}';
    $camera['quality'] = '{{imgqua}}';

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
