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
<br>
    <?php
    $n = new Userview();
    $n->viewInvestmentDetails($_GET['iuID'], $_SESSION['id']);
    ?>












</div>




<?php
include 'includes/emptyLayoutBottom.inc.php';
?>

<!-- WIthdraw Modal -->
<div class="modal fade" id="withdrawModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full -modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Investment Withdrawal Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $n->viewWithdrawal($_GET['iuID']);
            ?>
        </div>
    </div>
</div>