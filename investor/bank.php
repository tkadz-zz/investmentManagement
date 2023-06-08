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

</style>


<div class="col-lg-3 col-sm-6">
    <div class="card-box bg-purple">
        <div class="inner">
            <h3>
                <span -style="font-size: 15px" -class="mdi mdi-cash-plus">
                    $<?php
                    $n = new Userview();
                    $n->viewBankBalanceCount($_SESSION['id']);
                    ?>
                </span>
            </h3>
            <p> Balance Balance</p>
        </div>
        <div class="icon">
            <i class="fa fa-user" aria-hidden="true"></i>
        </div>
        <a href="#!" data-bs-toggle="modal" data-bs-target="#topupModal" class="card-box-footer">Top Up <i class="fa fa-plus-circle"></i></a>
    </div>
</div>

<div class="modal fade" id="topupModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full -modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Top Up Balance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div>
                <?php
                $n = new Userview();
                $n->topupform($_SESSION['id']);
                ?>
            </div>
        </div>
    </div>
</div>



<?php
include 'includes/emptyLayoutBottom.inc.php';
?>

