<?php
include 'includes/emptyLayoutTop.inc.php';
include 'includes/miniTab.inc.php';
?>


    <br>
    <div class="btn btn-outline-secondary btn-sm rounded text-decoration-none" data-size="large"><a href="javascript:history.back()" class="fb-xfbml-parse-ignore"><span class="fa fa-chevron-circle-left"></span> Back</a></div>
    <br>
    <br>
    <a id="top" href="#bottom">Go To Last Message <span class="fa fe-arrow-down"></span> </a>
    <br>
    <br>

<?php
$userID = $_GET['userID'];
$adminID = $_SESSION['id'];
$n = new Userview();
$n->adminMessage($adminID, $userID);
?>





    <br>
    <br>
    <a id="bottom" href="#top">Go To First Message <span class="fa fe-arrow-down"></span> </a>





<?php
include 'includes/emptyLayoutBottom.inc.php';
?>