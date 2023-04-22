<?php
include("autoloader.inc.php");


if(isset($_POST['stage2'])) {

    $DOB = $_POST['DOB'];
    $marital = strtoupper($_POST['marital']);
    $gender = strtoupper($_POST['gender']);
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $country = strtoupper($_POST['country']);
    $religion = strtoupper($_POST['religion']);
    $about = $_POST['about'];

    try {
        $stage2 = new Usercontr();
        $stage2->Stage2($DOB, $marital, $gender, $phone, $email, $country, $religion, $about, $_SESSION['id']);
    }
    catch (TypeError $e){
        echo "Error" . $e->getMessage();
    }




}


elseif(isset($_POST['stage3'])) {

    $institute = $_POST['institute'];
    $program = $_POST['program'];
    $programType = $_POST['programType'];
    $dateStart = $_POST['dateStart'];
    $dateEnd = $_POST['dateEnd'];

    try {
        $stage3 = new Usercontr();
        $stage3->Stage3($institute, $program, $programType, $dateStart, $dateEnd, $_SESSION['id']);
    }
    catch (TypeError $e){
        echo "Error" . $e->getMessage();
    }




}

elseif(isset($_POST['stage4'])) {

    try {
        $stage4 = new Usercontr();
        $stage4->Stage4($_SESSION['id']);
    }
    catch (TypeError $e){
        echo "Error" . $e->getMessage();
    }




}



else{
    echo 'Action is prohibited';
}


?>