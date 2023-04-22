<?php
include("autoloader.inc.php");

if(isset($_POST['btn-signin'])) {
    $loginID = $_POST["loginID"];
    $password = $_POST["password"];

    try {
        $login = new Usercontr();
        $login->SigninUser($loginID, $password);

    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();
    }
}
else{
    echo "<script type='text/javascript'>;
             window.location='../unauthorized.php';
            </script>";
}