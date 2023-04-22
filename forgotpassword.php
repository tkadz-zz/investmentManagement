<?php include('includes/navbar.inc.php'); ?>



    <!-- Mashead header-->
    <header class="masthead">
        <div class="container px-5">
            <div class="row gx-5 align-items-center">

                <div class="col-lg-6">
                    <!-- Mashead text and app badges-->
                    <div class="mb-5 mb-lg-0 text-center text-lg-start">
                        <h1 class="display-1 lh-1 mb-3">Lost or Forgot Password</h1>
                        <p class="lead fw-normal text-muted mb-5">we offer different ways to recover your account</p>
                        <div class="d-flex flex-column flex-lg-row align-items-center">
                        </div>
                    </div>
                </div>


                <div class="col-lg-6">
                    <div -class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Recover your account</h1>
                        </div>
                        <?php include "includes/error_report.inc.php"; ?>

                        <form class="user" method="POST" action="includes/forgotpassword.inc.php">
                            <div class="form-group col-md-12">
                                <input type="email" class="form-control form-control-user"
                                       id="exampleInputText"
                                       aria-describedby="emailHelp"
                                       placeholder="Email of your account"
                                       name="email"
                                       value="<?php
                                       if(isset($_GET['email'])){
                                           echo $_GET['email'];
                                       }
                                       else{
                                           '';
                                       }
                                       ?>"
                                />
                            </div>

                            <br>

                            <!--
                            <div class="form-group">
                                <div class="custom-control custom-checkbox small">
                                    <input type="checkbox" class="custom-control-input" id="customCheck">
                                    <label class="custom-control-label" for="customCheck">Remember
                                        Me</label>
                                </div>
                            </div>
                            -->
                            <button name="btn-recover-password" class="btn btn-primary btn-user btn-block">
                                Send Link <span class="fa fa-envelope"></span>
                            </button>

                            <br>

                        </form>


                        <br>
                        <div class="text-center">
                            <a class="small" href="#!">Try another way <span class="fa fa-external-link"></span></a>
                        </div>
                        <hr>
                        <?php
                        if(!isset($_SESSION['id']))
                        {
                            ?>
                            <div class="text-center">
                                <a class="small" href="signup.php">Create an Account!</a>
                            </div>
                            <?php
                        }
                        ?>


                    </div>
                </div>


            </div>
        </div>
    </header>









<?php include('includes/footer.inc.php'); ?>