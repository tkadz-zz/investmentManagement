<?php
include("autoloader.inc.php");


if (isset($_POST['btn_updatePassword'])){
    $op = $_POST['op'];
    $np = $_POST['np'];
    $cp = $_POST['cp'];
    $id = $_SESSION['id'];

    if($np != $cp){
        $_SESSION['type'] = 's';
        $_SESSION['err'] = 'New Password and Old Password Did Not Match';
        echo "<script type='text/javascript'>;
                      window.location='../password.php';
                    </script>";
    }
    else{
        try {
            $prof = new Usercontr();
            $prof->updatePassword($op, $cp, $id);
        } catch (TypeError $e) {
            echo "Error" . $e->getMessage();
        }
    }

}

?>