<?php
include("includes/autoloader.inc.php");

?>

<?php
if (isset($_GET['logout']) && ($_GET['logout'] == 'true')) {
    $newlogout = new Usercontr();
    $newlogout->log_out();

}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Invest
            <?php
                if(isset($_SESSION['id'] )) {
                    echo ' /' . $_SESSION['name'] . ' ' . $_SESSION['surname'];
                }
            ?>
        </title>
        <link rel="icon" type="image/x-icon" class="fa fa-briefcase" />
        <!-- Bootstrap icons-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
	<link href="vendor/google/bootstrap-icons.css" rel="stylesheet" />


        <!-- Google fonts-->
        <link rel="preconnect" href="https://fonts.gstatic.com" />


        <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@0,600;1,600&amp;display=swap" rel="stylesheet" />
	<link href="vendor/google/css2?family=Newsreader:ital,wght@0,600;1,600&amp;display=swap" rel="stylesheet" />


        <link href="vendor/google/css2?family=Mulish:ital,wght@0,300;0,500;0,600;0,700;1,300;1,500;1,600;1,700&amp;display=swap" rel="stylesheet" />
	<link href="vendor/google/css22?family=Mulish:ital,wght@0,300;0,500;0,600;0,700;1,300;1,500;1,600;1,700&amp;display=swap" rel="stylesheet" />


        <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;1,400&amp;display=swap" rel="stylesheet" />
	<link href="vendor/google/css222?family=Kanit:ital,wght@0,400;1,400&amp;display=swap" rel="stylesheet" />



        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="homestyles/css/styles.css" rel="stylesheet" />


        <!-- Font-Awesome 5.7 -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="vendor/google/font-awesome.min.css">


    </head>

<style>
</style>

    <body id="page-top">

    <?php include('includes/loader.inc.php') ?>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
            <div class="container px-5">
                <a class="navbar-brand fw-bold" href="home.php"><span class="fa fa-briefcase"></span> Invest<span></span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="bi-list"></i>
                </button>

                <?php
                if(isset($_SESSION['id'])) {
                    ?>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
			
                       

<div class="dropdown ms-auto me-4 my-3 my-lg-0">
  <a href="includes/dashboardRedirect.inc.php" class="btn btn-outline-inverse dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    <?php
                                    if(isset($_SESSION['role'])){
                                        echo  $_SESSION['name'] .' '. $_SESSION['surname'];
                                    }
                                    ?>
  </a>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    <li><a class="dropdown-item" href="includes/dashboardRedirect.inc.php"><span class="fa fa-tachometer"></span> <?php echo strtoupper($_SESSION['role']) . '&#145;S ' .'DASHBOARD' ?></a></li>
  </ul>
</div>

                        <a href="?logout=true" class="btn btn-danger rounded-pill px-3 mb-2 mb-lg-0" >
                        <span class="d-flex align-items-center">
                            <i class="fa fa-sign-out"> </i>
                            <span class="small"> Sign-out</span>
                        </span>
                        </a>
                    </div>
                <?php
                }
                else{
                    ?>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                        <li class="nav-item"><a href="signin.php" class="nav-link me-lg-3" href="#features"><span class="fa fa-sign-in"></span> Signin</a></li>
                    </ul>

                    <a href="signup.php" class="btn btn-primary rounded-pill px-3 mb-2 mb-lg-0" >
                        <span class="d-flex align-items-center">
                            <i class="fa fa-user-plus"> </i>
                            <span class="small"> Sign-up</span>
                        </span>
                    </a>

                </div>
                <?php
                }
                ?>


            </div>
        </nav>



