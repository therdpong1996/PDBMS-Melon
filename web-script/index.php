<?php

    require_once 'init.php';
    include_once 'include/header.php';
    include_once 'include/navbar.php';
    if (empty($_GET['view'])) {
    	include_once 'include/list.php';
    }elseif($_GET['view'] == 'upload'){
    	include_once 'include/upload.php';
    }else{
    	include_once 'include/info.php';
    }
    
    include_once 'include/footer.php';

?>
