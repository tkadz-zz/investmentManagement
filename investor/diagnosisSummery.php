<?php
include 'includes/emptyLayoutTop.inc.php';
?>

<?php
include 'includes/miniTab.inc.php';
?>



<h4 class="pt-3">Diagnosis Summery</h4>
<br>


<div class="row">
    <?php
    $cv = new Userview();
    $cv->viewDiagnosisSummery($_GET['duID']);
    ?>
</div>


<div>
    <br>
    <label style="font-size: 12px" class="card-description">Press Finish after making sure that everything is okay</label>
    <br>
    <a href="dashboard.php" class="btn btn-primary">Finish <span class="fa fa-check"></span> </a>

</div>


<?php
include 'includes/emptyLayoutBottom.inc.php';
?>
