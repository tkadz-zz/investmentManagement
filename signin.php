<?php include('includes/navbar.inc.php'); ?>

<?php
if(isset($_SESSION['id'])){
    $_SESSION['type'] = 'i';
    $_SESSION['err'] = 'Please logout first to login';
    echo "<script type='text/javascript'>
            history.back(-1);   
        </script>";
}
?>

    <!-- Mashead header-->
    <header class="masthead">
        <div class="container px-5">
            <div class="row gx-5 align-items-center">

                <div class="col-lg-6">
                    <!-- Mashead text and app badges-->
                    <div class="mb-5 mb-lg-0 text-center text-lg-start">
                        <h1 class="display-1 lh-1 mb-3">Login to your account here</h1>
                        <p class="lead fw-normal text-muted mb-5">We are happy to have you back</p>
                        <div class="d-flex flex-column flex-lg-row align-items-center">
                        </div>
                    </div>
                </div>


                <div class="col-lg-6">
                    <div -class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                        </div>
                        <?php include "includes/error_report.inc.php"; ?>

                        <form class="user" method="POST" action="includes/signin.inc.php">
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control form-control-user"
                                       id="exampleInputText"
                                       aria-describedby="emailHelp"
                                       placeholder="LoginID"
                                       name="loginID"
                                       value="<?php
                                       if(isset($_GET['loginID'])){
                                           echo $_GET['loginID'];
                                       }
                                       else{
                                           '';
                                       }
                                       ?>"
                                />
                            </div>

                            <br>

                            <div class="form-group col-md-12">
                                <input type="password" class="form-control form-control-user"
                                       id="exampleInputPassword"
                                       placeholder="Password"
                                       name="password"
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
                            <button name="btn-signin" class="btn btn-primary btn-user btn-block">
                                Login <span class="fa fa-sign-in"></span>
                            </button>

                            <br>

                        </form>


                        <hr>
                        <div class="text-center">
                            <a class="small" href="forgotpassword.php">Forgot Password?</a>
                        </div>
                        <!--
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
                            -->


                    </div>
                </div>


            </div>
        </div>
    </header>








<?php include('includes/footer.inc.php'); ?>