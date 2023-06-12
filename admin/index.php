<?php
include("../includes/autoloader.inc.php");

if(!isset($_SESSION['id'])){
  $_SESSION['id'] = NULL;
}

if($_SESSION["id"] == "" || $_SESSION["id"] == NULL){
  echo "<script type='text/javascript'>
    window.location='../signin.php';
    </script>";
}

else{

  if(isset($_SESSION['role'])){
    echo "<script type='text/javascript'>
      window.location='dashboard.php';
      </script>";
  }



}


 ?>
