<?php
include("autoloader.inc.php");


if(isset($_POST['btn_addDiagnosis'])){



    $bloodPressure = $_POST['bloodPressure'];
    $pulse = $_POST['pulse'];
    $glucose = $_POST['glucose'];
    $gcs = $_POST['gcs'];
    $temp = $_POST['temp'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $diagnosis = $_POST['diagnosis'];
    $additional = $_POST['additional'];

    $userID = $_GET['userid'];
    $duID = $_POST['duid'];
    $doctorID = $_SESSION['id'];
    $dateAdded = date("Y-m-d h:m:i");

    if($gcs > 15){
        $_SESSION['type'] = 'd';
        $_SESSION['err'] = 'GCS should be between 1 and 15';
        echo "<script type='text/javascript'>;
             history.back(-1);
            </script>";
    }

    else{
        try {
            $n = new Usercontr();
            $n->addDiagnosis($bloodPressure, $pulse, $glucose, $gcs, $temp, $weight, $height, $diagnosis, $additional, $duID, $doctorID, $dateAdded, $userID);
        } catch (TypeError $e) {
            echo "Error" . $e->getMessage();

        }
    }
}



?>
