<?php
if(!isset($_SESSION['id'])){
    //redirect to prohibited
    echo "<script type='text/javascript'>;
            window.location='../unauthorized.php';
          </script>";
}
if(!isset($_SESSION['role'])){
    //redirect to prohibited
    echo "<script type='text/javascript'>;
            window.location='../unauthorized.php';
          </script>";
}
if($_SESSION['role'] != 'admin'){
    //redirect to prohibited
    echo "<script type='text/javascript'>;
            window.location='../unauthorized.php';
          </script>";
}