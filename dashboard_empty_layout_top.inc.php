<?php include('includes/mainheader.inc.php') ?>



<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include('includes/sidebar.inc.php') ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include('includes/toolbar.inc.php') ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">



<?php

    if($_SESSION['id'] == NULL || $_SESSION['id'] == ""){
        echo "<script type='text/javascript'>;
             window.location='index.php';
            </script>";
    }
?>


