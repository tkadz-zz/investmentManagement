<?php
include("autoloader.inc.php");

if(isset($_GET['msgID'])) {
    $msgID = $_GET['msgID'];


    try {
        $s = new Usercontr();
        $s->delMsg($msgID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }

}