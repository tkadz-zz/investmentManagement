<?php
include("autoloader.inc.php");


    $iuID = $_POST['iuID'];
    $userID = $_SESSION['id'];

    try {
        $s = new Usercontr();
        $s->terminateInv($iuID, $userID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }



