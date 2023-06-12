<?php
include 'includes/emptyLayoutTop.inc.php';
?>

<?php
include 'includes/miniTab.inc.php';
?>

<br>
<div class="btn btn-outline-secondary btn-sm rounded text-decoration-none" data-size="large"><a href="javascript:history.back()" class="fb-xfbml-parse-ignore"><span class="fa fa-chevron-circle-left"></span> Back</a></div>
<br>
<h4 class="mt-0 text-muted header-title pt-4">Doctor Details</h4>

<?php
$n = new Userview();
$n->viewDoctorDetails($_GET['userID']);
?>




<?php
include 'includes/emptyLayoutBottom.inc.php';
?>

