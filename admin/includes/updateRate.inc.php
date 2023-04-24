<?php
include("autoloader.inc.php");


if(isset($_POST['btn_update_rate'])){
    $type = $_POST['type'];
    $percentage = $_POST['percentage'];
    $period = $_POST['period'];

    try {
        $n = new Usercontr();
        $n->upateRates($type, $percentage, $period);
    }catch (TypeError $e){

    }
}