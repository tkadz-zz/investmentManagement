<?php
include 'includes/emptyLayoutTop.inc.php';
?>

<?php
include 'includes/miniTab.inc.php';
?>



<div class="mt-4 mb-4">
    <div class="btn btn-outline-secondary btn-sm rounded text-decoration-none" data-size="large"><a href="javascript:history.back()" class="fb-xfbml-parse-ignore"><span class="fa fa-chevron-circle-left"></span> Back</a></div>
<br>
<br>


    <?php
    $n = new Userview();
    $n->ViewRequestDetails($_GET['rID'])
    ?>

</div>




<?php
include 'includes/emptyLayoutBottom.inc.php';
?>

