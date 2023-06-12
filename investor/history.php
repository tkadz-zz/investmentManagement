<?php
include 'includes/emptyLayoutTop.inc.php';
?>

<?php
include 'includes/miniTab.inc.php';
?>



<div class="mt-4 mb-4">
    <br>
    <div class="btn btn-outline-secondary btn-sm rounded text-decoration-none" data-size="large"><a href="javascript:history.back()" class="fb-xfbml-parse-ignore"><span class="fa fa-chevron-circle-left"></span> Back</a></div>
    <br>




    <div class="row">
        <div class="col-12">

            <!--<a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>-->
            <div id="--printableArea" class="card-box">
                <h4 class="mt-0 header-title"></h4>
                <p class="text-muted font-14 mb-3">
                    Investment Withdrawal History
                </p>
                <table id="datatable" class="table table-bordered dt-responsive nowrap">

                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Investment ID</th>
                        <th>Amount</th>
                        <th>Date Withdrawn</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    $n = new Userview();
                    $n->viewHistory($_SESSION['id']);
                    ?>
                    </tbody>


                </table>
            </div>


        </div>


    </div>

</div>




<?php
include 'includes/emptyLayoutBottom.inc.php';
?>

