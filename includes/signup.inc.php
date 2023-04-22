<?php
include("autoloader.inc.php");

$nameRaw = $_POST["name"];
$name = strtoupper($nameRaw);

$surnameRaw = $_POST["surname"];
$surname = strtoupper($surnameRaw);

$reNumberRaw = $_POST["loginID"];
$loginID = strtoupper($reNumberRaw);

$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];

if($password != $confirmPassword){
    $message = "type=d&err=Password did not match";
  echo "<script type='text/javascript'>;
             window.location='../signup.php';
            </script>";
}

elseif(strlen($loginID) < 1){
    $_SESSION['type'] = 'd';
    $_SESSION['err'] = 'RegNumber is empty';
    echo "<script type='text/javascript'>;
             window.location='../signup.php';
            </script>";
}

elseif(strlen($name) < 1){
    $_SESSION['type'] = 'd';
    $_SESSION['err'] = 'Name is empty';
  echo "<script type='text/javascript'>;
             window.location='../signup.php';
            </script>";
}

elseif(strlen($surname) < 1){
    $_SESSION['type'] = 'd';
    $_SESSION['err'] = 'Surname is empty';
  echo "<script type='text/javascript'>;
             window.location='../signup.php';
            </script>";
}

elseif (strlen($password) < 8 || strlen($confirmPassword) < 8){
    $_SESSION['type'] = 'd';
    $_SESSION['err'] = 'Password is too short';
  echo "<script type='text/javascript'>;
             window.location='../signup.php';
            </script>";
}


else{




    $joined = date("Y-m-d h:m:i");
    $reg_status = 1;
    $activeStatus = 1;
    $userRole = "investor";


    try {
      $sign_up_now = new Usercontr();
        $sign_up_now = new Usercontr();
        $sign_up_now->addUser($name, $surname, $loginID, $userRole, $activeStatus, $confirmPassword);
    } catch (TypeError $e) {
      echo "Error" . $e->getMessage();

    }



}


 ?>
