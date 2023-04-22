<?php
include 'autoloader.inc.php';

if(isset($_POST['btn-recover-password'])){
    //forgotpassword
    $legnth = 30;
    $id = $_SESSION['id'];
    $email = $_POST['email'];

    $n = new UserView();
    $uniqueKey = $n->randomNumbers($legnth);


    try {
        $login = new UserController();
        $login->forgotPassword($email, $uniqueKey, $id);

    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();
    }





}


?>
