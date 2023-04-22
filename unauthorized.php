<?php include('includes/navbar.inc.php'); ?>



    <!-- Mashead header-->
    <header class="masthead">
        <div class="container px-5">
            <div class="row gx-5 align-items-center">

                <div class="col-lg-12">
                    <!-- Mashead text and app badges-->
                    <div class="mb-5 mb-lg-0 text-center text-lg-start">
                        <div class="animated--grow-in fadeout my-3 p-3 -bg-white rounded -shadow-sm -alert alert-danger">
                            <h1 class="display-1 lh-1 mb-3">Unauthorised Access <span class="fa fa-exclamation-triangle"></span> </h1>
                        </div>
                        <p class="lead fw-normal text-muted mb-5">This may be due to the following reasons
                        <ul class="text-muted mb-5">
                            <li>Trying to access a page you are not supposed to</li>
                            <li>Trying to change a setting a page you are not supposed to</li>
                            <li>Trying to access resources that are not available yet or under update / maintenance <span class="fa fa-gear fa-spin"></span></li>
                        </ul>
                        </p>

                        <hr>


                        <?php
                        if(isset($_SESSION['id']) || isset($_SESSION['role'])){
                            ?>
                            <a href="#!" onclick="history.go(-1)" class="btn btn-primary btn-user btn-block"><span class="fa fa-chevron-circle-left"></span> Go Back</a>
                            <a href="?logout=true" class="btn btn-danger btn-user btn-block">Logout <span class="fa fa-sign-out"></span> </a>
                            <?php
                        }
                        else
                        {
                            ?>
                            <a href="student/index.php" class="btn btn- btn-user btn-block text-primary">Sign-in <span class="fa fa-sign-in"></span> </a>
                            <a href="index.php" class="btn btn-primary btn-user btn-block">Home <span class="fa fa-home"></span> </a>
                            <?php
                        }
                        ?>


                        <p><div class="d-flex flex-column flex-lg-row align-items-center">
                        </div>
                    </div>
                </div>



            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </header>






    <!-- Quote/testimonial aside-->
    <aside class="text-center bg-gradient-primary-to-secondary">
        <div class="container px-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-xl-8">
                    <div class="h2 fs-1 text-white mb-4">"An intuitive solution to common problems that most companies face, wrapped up in a single website!"</div>

                </div>
            </div>
        </div>
    </aside>









<?php include('includes/footer.inc.php'); ?>