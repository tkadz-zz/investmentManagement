<?php
include("autoloader.inc.php");


if(isset($_POST['btn_topUpBalance'])){

    $userID = $_SESSION['id'];
    $balance = $_POST['balance'];

    try {
        $n = new Usercontr();
        $n->topUpBalance($balance, $userID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }

}



?>
