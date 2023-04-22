<?php include('includes/navbar.inc.php'); ?>



    <!-- Mashead header-->
    <header class="masthead">
        <div class="container px-5">
            <div class="row gx-5 align-items-center">

                <div class="col-lg-6">
                    <!-- Mashead text and app badges-->
                    <div class="mb-5 mb-lg-0 text-center text-lg-start">
                        <h3 class="display-1 lh-1 mb-3">Hello
                            <?php
                            echo strtoupper($_SESSION['loginIDTemp']);
                            ?>

                        </h3>
                        <p class="lead fw-normal text-muted mb-5">setup a password to activate your account</p>
                        <div class="d-flex flex-column flex-lg-row align-items-center">
                        </div>
                    </div>
                </div>


                <div class="col-lg-6">
                    <div -class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Set Password!</h1>
                        </div>
                        <?php include "includes/error_report.inc.php"; ?>

                        <form class="user" method="POST" action="includes/setpassword.inc.php">
                            <div class="form-group row">

                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user"
                                           id="password"
                                           placeholder="Password"
                                           name="password"
                                           required
                                           onkeyup='check();'
                                           minlength="8"
                                    >

                                </div>

                                <br>


                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user"
                                           id="confirmPassword"
                                           placeholder="Repeat Password"
                                           name="confirmPassword"
                                           required
                                           onkeyup='check();'
                                           minlength="8"
                                    >
                                </div>

                                <br>

                                <div>

                                    <span id='message'></span>

                                </div>



                                <br>



                            </div>
                            <!--
                            <div class="form-group">
                                <div class="custom-control custom-checkbox small">
                                    <input type="checkbox" class="custom-control-input" id="customCheck">
                                    <label class="custom-control-label" for="customCheck">Remember
                                        Me</label>
                                </div>
                            </div>
                            -->
                            <button id="save-btn" name="save-btn" class="btn btn-primary btn-user btn-block">
                                Login <span class="fa fa-sign-in"></span>
                            </button>

                            <br>
                            <script type="text/javascript">
                                //close div in 5 secs
                                window.setTimeout("closeDisDiv();", 6000);

                                function closeDisDiv(){
                                    document.getElementById("divDis").style.display="none";
                                    $(".fadeout").click(function (){
                                        $("div").fadeOut();
                                    });
                                }
                            </script>


                            <script>
                                var check = function() {
                                    if (document.getElementById('password').value ==
                                        document.getElementById('confirmPassword').value) {
                                        document.getElementById('message').style.color = 'green';
                                        document.getElementById("save-btn").disabled = false;
                                        document.getElementById('message').innerHTML = '<div id="divDis" class="animated--grow-in fadeout my-3 p-3 bg-white rounded shadow-sm alert alert-success"><span class="fa fa-check-circle"></span> Password matched</div>';
                                    }
                                    else {
                                        document.getElementById('message').style.color = 'red';
                                        document.getElementById("save-btn").disabled = true;
                                        document.getElementById('message').innerHTML = '<div class="animated--grow-in fadeout my-3 p-3 bg-white rounded shadow-sm alert alert-danger"><span class="fa fa-exclamation-circle"></span> Password not matching Confirm Password</div>';
                                    }


                                }
                            </script>

                        </form>


                        <hr>



                    </div>
                </div>


            </div>
        </div>
    </header>








<?php
if($_SESSION['loginIDTemp'] == NULL){
    $_SESSION['type'] = 'w';
    $_SESSION['err'] = 'You have been redirected to the sign-in page. Please confirm your Reg-Number again to continue';
    echo "<script type='text/javascript'>;
          window.location='signin.php';
        </script>";
}

unset($_SESSION['regNumTemp']);
?>



<?php include('includes/footer.inc.php'); ?>