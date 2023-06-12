<?php
include("autoloader.inc.php");


if(isset($_POST['btn_updateInvestment'])){

    $iuID = $_POST['iuID'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $returns = $_POST['returns'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    try {
        $n = new Usercontr();
        $n->updateInvestment($iuID, $name, $type, $description, $category, $returns);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }

}



?>
