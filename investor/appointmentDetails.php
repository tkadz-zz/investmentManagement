<?php
include 'includes/emptyLayoutTop.inc.php';
include 'includes/miniTab.inc.php';
?>

    <h4 class="mt-0 text-muted header-title pt-4">Appointment Details</h4>
<br>


    <div class="btn btn-outline-secondary btn-sm rounded text-decoration-none" data-size="large"><a href="javascript:history.back()" class="fb-xfbml-parse-ignore"><span class="fa fa-chevron-circle-left"></span> Back</a></div>
    <br>
    <br>



<?php
$n = new Userview();
$n->viewAppointmentDetails($_GET['appID']);
?>





<?php
include 'includes/emptyLayoutBottom.inc.php';
?>