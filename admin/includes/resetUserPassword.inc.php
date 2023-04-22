<?php
include("autoloader.inc.php");


    $userrID = $_GET['userID'];


        try {
            $prof = new Usercontr();
            $prof->resetUserPassword($userrID);
        } catch (TypeError $e) {
            echo "Error" . $e->getMessage();
        }



?>