<?php
include("autoloader.inc.php");


    $iuID = $_GET['iuID'];
    $userID = $_SESSION['id'];

    try {
        $s = new Usercontr();
        $s->finilizeRequest($iuID, $userID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }



