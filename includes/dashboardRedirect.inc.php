<?php
include('autoloader.inc.php');


if(isset($_SESSION['role'])){

$myrole = $_SESSION['role'];


	echo "<script type='text/javascript'>;
             window.location='../".$_SESSION['role']."';
            </script>";

}


else{
//prohibited session
    echo "<script type='text/javascript'>;
             window.location='../unauthorized.php';
            </script>";
}




?>