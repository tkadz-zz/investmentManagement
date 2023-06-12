<?php
include 'includes/emptyLayoutTop.inc.php';
include 'includes/miniTab.inc.php';
?>





<?php

$studentProfile = new Userview();
$studentProfile->viewChangeUserPassword($_GET['userID']);

?>







<?php
include 'includes/emptyLayoutBottom.inc.php';
?>