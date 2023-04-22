<?php
include("autoloader.inc.php");


if(isset($_POST['send'])){
    $adminID = $_SESSION['id'];
    $userID = $_POST['userID'];
    $msg = $_POST['msg'];
    if($_SESSION['role'] == 'investor'){
        $tofrom = 1;
    }else{
        $tofrom = 0;
    }
    try {
        $n = new Usercontr();
        $n->sendMsg($adminID, $userID, $msg, $tofrom);
    }catch (TypeError $e){
        echo 'ERROR: ' . $e->getMessage();
    }

}