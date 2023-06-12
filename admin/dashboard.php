<?php
include 'includes/emptyLayoutTop.inc.php';
?>

<?php
include 'includes/miniTab.inc.php';
?>


<style>
    .card-box {
        position: relative;
        color: #fff;
        padding: 20px 10px 40px;
        margin: 20px 0px;
    }
    .card-box:hover {
        text-decoration: none;
        color: #f1f1f1;
    }
    .card-box:hover .icon i {
        font-size: 100px;
        transition: 1s;
        -webkit-transition: 1s;
    }
    .card-box .inner {
        padding: 5px 10px 0 10px;
    }
    .card-box h3 {
        font-size: 27px;
        font-weight: bold;
        margin: 0 0 8px 0;
        white-space: nowrap;
        padding: 0;
        text-align: left;
    }
    .card-box p {
        font-size: 15px;
    }
    .card-box .icon {
        position: absolute;
        top: auto;
        bottom: 5px;
        right: 5px;
        z-index: 0;
        font-size: 72px;
        color: rgba(0, 0, 0, 0.15);
    }
    .card-box .card-box-footer {
        position: absolute;
        left: 0px;
        bottom: 0px;
        text-align: center;
        padding: 3px 0;
        color: rgba(255, 255, 255, 0.8);
        background: rgba(0, 0, 0, 0.1);
        width: 100%;
        text-decoration: none;
    }
    .card-box:hover .card-box-footer {
        background: rgba(0, 0, 0, 0.3);
    }
    .bg-blue {
        background-color: #00c0ef !important;
    }
    .bg-green {
        background-color: #00a65a !important;
    }
    .bg-orange {
        background-color: #f39c12 !important;
    }
    .bg-red {
        background-color: #d9534f !important;
    }
    .bg-purple {
        background-color: #aa35b2 !important;
    }
    .bg-lime {
        background-color: rgba(50, 56, 55, 0.98) !important;
    }
    .bg-darkPurple {
        background-color: rgba(86, 14, 64, 0.98) !important;
    }

</style>

<div class="mt-4 mb-4">


    <div>
        <a data-bs-toggle="modal" data-bs-target="#addUserModal" href="#!" id="#!" class="btn btn-outline-primary"><span class="fa fa-user-plus"></span> Add User</a>
    </div>

    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card-box bg-blue">
                <div class="inner">
                    <h3>
                        <?php
                        $query = "SELECT * FROM users";
                        $o = new Userview();
                        $o->CountView($query);
                        ?>
                    </h3>
                    <p> All System Users </p>
                </div>
                <div class="icon">
                    <i class="fa fa-users" aria-hidden="true"></i>
                </div>

            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="card-box bg-green">
                <div class="inner">
                    <h3> <?php
                        $query = "SELECT * FROM admin";
                        $o = new Userview();
                        $o->CountView($query);
                        ?> </h3>
                    <p> Admin Accounts </p>
                </div>
                <div class="icon">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>

            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card-box bg-orange">
                <div class="inner">
                    <h3> <?php
                        $query = "SELECT * FROM investor";
                        $o = new Userview();
                        $o->CountView($query);
                        ?>
                    </h3>
                    <p> Investor Accounts </p>
                </div>
                <div class="icon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>

            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card-box bg-red">
                <div class="inner">
                    <h3> <?php
                        $query = "SELECT * FROM investments";
                        $o = new Userview();
                        $o->CountView($query);
                        ?>
                    </h3>
                    <p> Investments </p>
                </div>
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>
                <a href="invetsments.php" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-3 col-sm-6">
            <div class="card-box bg-primary">
                <div class="inner">
                    <h3>
                        <?php
                        $query = "SELECT * FROM request WHERE response=0";
                        $o = new Userview();
                        $o->CountView($query);
                        ?>
                    </h3>
                    <p>Investment Request </p>
                </div>
                <div class="icon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
                <a href="requests.php" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="card-box bg-darkPurple">
                <div class="inner">
                    <h3>
                        <?php
                        $query = "SELECT * FROM withdraw";
                        $o = new Userview();
                        $o->CountView($query);
                        ?>
                    </h3>
                    <p>Investment Withdrawals </p>
                </div>
                <div class="icon">
                    <i class="mdi mdi-cash-usd" aria-hidden="true"></i>
                </div>
                <a href="history.php" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-12">

            <!--<a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>-->
            <div id="--printableArea" class="card-box">
                <h4 class="mt-0 header-title"></h4>
                <p class="text-muted font-14 mb-3">
                    User Summery
                </p>
                <table id="datatable" class="table table-bordered dt-responsive nowrap">

                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Role</th>
                        <th>status</th>
                        <th>More</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    $n = new Userview();
                    $n->ViewAllUsers();
                    ?>
                    </tbody>


                </table>
            </div>

            <script>
                function printDiv(divName) {
                    var printContents = document.getElementById(divName).innerHTML;
                    var originalContents = document.body.innerHTML;

                    document.body.innerHTML = printContents;

                    window.print();

                    document.body.innerHTML = originalContents;
                }
            </script>

        </div>


    </div>
</div>

</div>


<?php
include 'includes/emptyLayoutBottom.inc.php';
?>

