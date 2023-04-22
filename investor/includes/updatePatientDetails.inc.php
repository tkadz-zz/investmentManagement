<?php
include("autoloader.inc.php");


if(isset($_POST['btn_updatePatient'])){

    $userid = $_GET['userid'];

    //personal
    $nameRaw = $_POST["name"];
    $name = strtoupper($nameRaw);
    $surnameRaw = $_POST["surname"];
    $surname = strtoupper($surnameRaw);
    $dob = $_POST['dob'];
    $sex = $_POST['sex'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $nationalID = $_POST['nationalID'];

    //medical
    $medicalName = $_POST['medicalName'];
    $medicalPlan = $_POST['medicalPlan'];

    //NextOfKin(nok)
    $nokname = strtoupper($_POST['nokname']);
    $noksurname = strtoupper($_POST['noksurname']);
    $nokPhone = $_POST['nokPhone'];

    //$joined = date("Y-m-d h:m:i");
    //$activeStatus = 1;

    try {
        $s = new Usercontr();
        $s->updatePatientDetails($name, $surname, $nationalID, $dob, $sex, $phone, $address, $medicalName, $medicalPlan, $nokname, $noksurname, $nokPhone, $userid);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }

}



?>
