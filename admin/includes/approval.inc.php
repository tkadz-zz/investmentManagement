<?php
include("autoloader.inc.php");


if(isset($_POST['btn_approval'])){

    $rID = $_POST['rID'];
    $iuID = $_POST['iuID'];
    $response = $_POST['response'];
    $userID = $_SESSION['id'];


    try {
        $n = new Usercontr();
        $n->requestApproval($response, $rID, $iuID, $userID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }

}



?>
