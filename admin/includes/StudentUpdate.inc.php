<?php

include("autoloader.inc.php");



if (isset($_POST['btn_updateProfile'])) {
    $name = strtoupper($_POST["name"]);
    $surname = strtoupper($_POST["surname"]);
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $sex = strtoupper($_POST["sex"]);
    $dob = $_POST["dob"];

    try {
        $prof = new StudentUpdate();
        $prof->studentUpdateProfile($name,$surname,$phone, $email,$sex,$dob,$_SESSION['id']);

    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();
    }
}


//Update Password
elseif (isset($_POST['btn_updatePassword'])){
    $op = $_POST['op'];
    $np = $_POST['np'];
    $cp = $_POST['cp'];



    if($np != $cp){
        echo "<script type='text/javascript'>;
                  window.location='../password.php?type=w&err=New Password and Old Password Did Not Match';
              </script>";
    }
    else{
        try {
            $prof = new StudentUpdate();
            $prof->studentUpdatePassword($op, $cp, $_SESSION['id']);

        } catch (TypeError $e) {
            echo "Error" . $e->getMessage();
        }
    }

}

else {
    echo "<script type='text/javascript'>;
             window.location='../unauthorized.php';
            </script>";
}

?>