<?php
include("autoloader.inc.php");

if(isset($_GET['pID'])) {
    $pID = $_GET['pID'];
    $duID = $_GET['duID'];


    try {
        $s = new Usercontr();
        $s->deletePrescription($pID, $duID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }

}

