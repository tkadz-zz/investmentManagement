<?php
include 'includes/emptyLayoutTop.inc.php';
?>

<?php
include 'includes/miniTab.inc.php';
?>

<br>
<div class="btn btn-outline-secondary btn-sm rounded text-decoration-none" data-size="large"><a href="javascript:history.back()" class="fb-xfbml-parse-ignore"><span class="fa fa-chevron-circle-left"></span> Back</a></div>
<br>
<h4 class="mt-0 text-muted header-title pt-4">Medical History</h4>

<div class="mt-4 mb-4">
    <div class="row">
        <div class="col-sm-12">
            <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active ps-0" id="home-tab" -data-bs-toggle="tab" href="addDiagnosis.php?userid=<?php echo $_GET['userid'] ?>" role="tab" aria-controls="overview" aria-selected="true"> </span> Add Diagnosis <span class="mdi mdi-plus"></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active " id="profile-tab" -data-bs-toggle="tab" href="patientSetup.php?userid=<?php echo $_GET['userid'] ?>" role="tab" aria-selected="false"> Patient Details <span class="mdi mdi-eye"></span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <br>
    <br>

    <div class="row">
        <div class="col-12">

            <!--<a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>-->
            <div id="--printableArea" class="card-box">
                <h4 class="mt-0 header-title"></h4>
                <p class="text-muted font-14 mb-3">
                    Showing Patient Medical History
                </p>
                <table id="datatable" class="table table-bordered dt-responsive nowrap">

                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Surname</th>
                        <th>Diagnosis ID</th>
                        <th>Diagnosis Date</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    $n = new Userview();
                    $n->ViewPatientMedicalHistory($_GET['userid']);
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




<?php
include 'includes/emptyLayoutBottom.inc.php';
?>

