<?php
include("autoloader.inc.php");


$iuID = $_POST['iuID'];
$amount = $_POST['amount'];
$userID = $_SESSION['id'];

try {
    $s = new Usercontr();
    $s->withdraw($amount, $iuID, $userID);
} catch (TypeError $e) {
    echo "Error" . $e->getMessage();

}



