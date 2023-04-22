<?php
include("autoloader.inc.php");



    $iuID = $_GET['iuID'];


    try {
        $n = new Usercontr();
        $n->delInv($iuID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }





?>
