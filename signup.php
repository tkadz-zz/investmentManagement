<?php include('includes/navbar.inc.php'); ?>


    <header class="masthead">
        <div class="container px-5">
             <?php //include 'includes/progress_bar.inc.php' ?>
            <div class="col-lg-6">
                <div -class="p-5">
                    <div style="font-size: 14px">
                        <?php include('includes/error_report.inc.php') ?>
                    </div>
                </div>
            </div>


            <div class="row gx-5 align-items-center">
                <div class="col-lg-6">
                    <div -class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form role="form" class="user" method="POST" action="includes/signup.inc.php">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user"
                                           id="exampleRegNumber"
                                           placeholder="Future Login-ID"
                                           autocomplete="off"
                                           name="loginID"
                                           required
                                    >
                                </div>
                            </div>
                            <br>

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user"
                                           id="exampleFirstName"
                                           placeholder="First Name"
                                           autocomplete="off"
                                           name="name"
                                           required
                                    >
                                </div>

                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user"
                                           id="exampleLastName"
                                           placeholder="Surname"
                                           autocomplete="off"
                                           name="surname"
                                           required
                                    >
                                </div>
                            </div>
                            <br>

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user"
                                           id="password"
                                           placeholder="Password"
                                           name="password"
                                           required
                                           onkeyup='check();'
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
                                    >
                                </div>
                                <br>

                                <div>
                                    <span id='message'></span>
                                </div>
                                <br>
                            </div>
                            <br>

                            <button id="save-btn" name="submitButton" class="btn btn-outline-primary btn-user btn-block" disabled="disabled">
                                Register Account <span class="fa fa-user-plus"></span>
                            </button>
                            <br>
                        </form>
                        <hr>


                        <div class="text-center">
                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                        </div>
                        <?php
                        if(!isset($_SESSION['id'])){
                            ?>
                            <div class="text-center">
                                <a class="small" href="signin.php">Already have an account? Sign-in!</a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="col-lg-6">
                    <!-- Mashead text and app badges-->
                    <div class="mb-5 mb-lg-0 text-center text-lg-start">
                        <h1 class="display-1 lh-1 mb-3">Create a free Investor account</h1>
                        <p class="lead fw-normal text-muted mb-5">We are happy you have decided to join us. Its a choice thats worth it
                        <div class="d-flex flex-column flex-lg-row align-items-center">
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </header>




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



<?php include('includes/footer.inc.php'); ?>