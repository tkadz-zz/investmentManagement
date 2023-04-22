<?php include('dashboard_empty_layout_top.inc.php') ?>









 <!-- Content Column -->
 <div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Welcome back <?php echo $_SESSION['name'] ?> </h6>
            </div>
        </div>

</div>



    <!-- Content Column -->
    <div class="col-lg-12 mb-4">

        <div class="row">


        <div class="col-xl-6 col-md-6 mb-4">
            <a href="registration.php" style="text-decoration: none;">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Registration Status
                                </div>
                                <?php
                                    $reg_status = new Userview();
                                    $reg_status->showRegStatus($_SESSION['id']);
                                ?>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-building fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            </div>


            

        </div>
    </div>



















<?php include('dashboard_empty_layout_bottom.inc.php') ?>
