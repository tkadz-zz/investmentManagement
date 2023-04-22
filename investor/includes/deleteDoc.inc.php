<?php
include("autoloader.inc.php");

if(isset($_GET['docID'])) {
    $docID = $_GET['docID'];
    $iuID = $_GET['iuID'];
    $userID = $_SESSION['id'];


    try {
        $s = new Usercontr();
        $s->deleteDoc($docID, $iuID, $userID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }

}

