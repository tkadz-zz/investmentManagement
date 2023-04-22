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
    $cv->viewUserDiagnosisSummery($_GET['userID'], $_GET['duID']);
    ?>
</div>




<?php
include 'includes/emptyLayoutBottom.inc.php';
?>
