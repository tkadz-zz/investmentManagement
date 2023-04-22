<?php
include("autoloader.inc.php");

$email = $_POST["email"];
$password = $_POST["password"];

try {
  $login = new Usercontr();
  $login->loginUserNow($email,$password);
  //echo "<script>
    //         alert('Loged In Succesfully');
      //       window.history.go(-1);
     //</script>";
} catch (TypeError $e) {
  echo "Error" . $e->getMessage();
}
