<?php
include 'includes/emptyLayoutTop.inc.php';
?>

<?php
include 'includes/miniTab.inc.php';
?>


<div class="mt-4 mb-4">

    <div class="row">

        <div class="col-md-6">
            <div class="card-box -card">
            <div class="card-header">
                <div class="h4"> Add Prescriptions</div>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <form class="form-group" method="POST" action="includes/addPrescription.inc.php?duID=<?php echo $_GET['duID'] ?>" enctype="multipart/form-data">

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label>Prescription</label>
                                <input class="form-control" type="text" name="prescription" placeholder="Type Prescription Here..." required>
                                    <br>
                                <button name="btn_addPrescriptoin" class="btn btn-outline-primary" type="submit">Add <span class="fa fa-plus"></span> </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>

        <div class="col-md-6">
            <div class="card-header">
                <div class="h4"> Added Prescriptions</div>
            </div>
            <br>
        <?php
        $n = new Userview();
        $n->viewAddedPrescription($_GET['duID'])
        ?>
        </div>


        <div>
            <br>
            <label style="font-size: 12px" class="card-description">Press next after you are done adding prescriptions</label>
            <br>
            <a href="uploadDocs.php?duID=<?php echo $_GET['duID'] ?>" class="btn btn-primary"><span class="fa fa-chevron-circle-left"></span>  Previous</a>
            <a href="diagnosisSummery.php?duID=<?php echo $_GET['duID'] ?>" class="btn btn-primary">Next <span class="fa fa-chevron-circle-right"></span> </a>

        </div>


    </div>

</div>




<?php
include 'includes/emptyLayoutBottom.inc.php';
?>

