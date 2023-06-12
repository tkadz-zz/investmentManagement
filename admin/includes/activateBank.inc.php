<?php
include("autoloader.inc.php");


if(isset($_GET['activateBank'])){

    $userID = $_GET['userID'];

    try {
        $n = new Usercontr();
        $n->activateBank($userID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }

}



?>
