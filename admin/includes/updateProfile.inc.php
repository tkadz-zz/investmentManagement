<?php
include("autoloader.inc.php");


if (isset($_POST['btn_updateProfile'])){
    $name = strtoupper($_POST['name']);
    $surname = strtoupper($_POST['surname']);
    $loginID= strtoupper($_POST['loginID']);
    $id = $_SESSION['id'];


    try {
        $prof = new Usercontr();
        $prof->updateAdminProfile($name, $surname, $loginID, $id);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();
    }


}

?>