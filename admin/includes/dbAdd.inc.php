<?php
include("autoloader.inc.php");


if(isset($_POST['btn_addInvstment'])){

    $uiID = $_POST['uiID'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $category = $_POST['category'];
    $description = $_POST['description'];


    try {
        $n = new Usercontr();
        $n->addInvestment($uiID, $name, $type, $description, $category);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }

}



?>
