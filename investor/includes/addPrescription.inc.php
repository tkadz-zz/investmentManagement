<?php
include("autoloader.inc.php");


if(isset($_POST['btn_addPrescriptoin'])){



    $prescription = $_POST['prescription'];
    $duID = $_GET['duID'];

    if(strlen($prescription) < 1){
        $_SESSION['type'] = 'd';
        $_SESSION['err'] = 'Prescription should not be empty';
        echo "<script type='text/javascript'>;
             history.back(-1);
            </script>";
    }

    else{
        try {
            $n = new Usercontr();
            $n->addDPrescription($prescription, $duID);
        } catch (TypeError $e) {
            echo "Error" . $e->getMessage();

        }
    }

}



?>
