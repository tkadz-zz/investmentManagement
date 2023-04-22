<?php
include 'includes/emptyLayoutTop.inc.php';
?>

<?php
include 'includes/miniTab.inc.php';
?>

<br>
<div class="btn btn-outline-secondary btn-sm rounded text-decoration-none" data-size="large"><a href="javascript:history.back()" class="fb-xfbml-parse-ignore"><span class="fa fa-chevron-circle-left"></span> Back</a></div>
<br>
<h4 class="mt-0 text-muted header-title pt-4">Patient Account</h4>

<div class="row">
    <div class="col-sm-12">
        <div class="home-tab">
            <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active ps-0" id="home-tab" -data-bs-toggle="tab" href="addDiagnosis.php?userid=<?php echo $_GET['userid'] ?>" role="tab" aria-controls="overview" aria-selected="true"> </span> Add Diagnosis <span class="mdi mdi-plus"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active " id="profile-tab" -data-bs-toggle="tab" href="medicalHistory.php?userid=<?php echo $_GET['userid'] ?>" role="tab" aria-selected="false"> Medical History <span class="mdi mdi-eye"></span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php
$new = new Userview();
$new->patientSetup($_GET['userid']);
?>


<?php
include 'includes/emptyLayoutBottom.inc.php';
?>

