<?php
include 'includes/emptyLayoutTop.inc.php';
?>

<?php
include 'includes/miniTab.inc.php';
?>



<h4 class="mt-0 text-muted header-title pt-4">Patient Account Setup</h4>
<a onclick="return confirm('Are you sure you want to reset user password?')" href="includes/resetUserPassword.inc.php?userID=<?php echo $_GET['userid'] ?>" class="btn btn-outline-primary"> Reset User Password</a>


<?php
$new = new Userview();
$new->patientSetup($_GET['userid']);
?>


<?php
include 'includes/emptyLayoutBottom.inc.php';
?>

