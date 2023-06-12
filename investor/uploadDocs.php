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
                <div class="h4"> Add Diagnosis Documents</div>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <form class="form-group" method="POST" action="includes/addDocs.inc.php?duID=<?php echo $_GET['duID'] ?>" enctype="multipart/form-data">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label>Title</label>
                                <input class="form-control" type="text" name="title" placeholder="Document Title..." required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label>Document Description</label>
                                <textarea style="height: 150px" class="form-control" name="description" placeholder="Add Document Description..." required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label>Allowed Formats: .jpg/ .jpeg/ .png/ .doc/ .pdf/ .docx</label>
                                <input class="form-control" name="doc" type="file" required>
                            </div>
                        </div>
                        <br>
                        <div>
                            <button name="btn_addDoc" type="submit" class="btn btn-outline-primary">Upload<span class="mdi mdi-upload"></span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>

        <div class="col-md-6">
            <div class="card-header">
                <div class="h4"> Uploaded Docs</div>
            </div>
            <br>
        <?php
        $n = new Userview();
        $n->viewDocLoop($_GET['duID'])
        ?>
        </div>


        <div>
            <br>
            <label style="font-size: 12px" class="card-description">Press next after you are done uploading documents</label>
            <br>
            <a href="addPrescription.php?duID=<?php echo $_GET['duID'] ?>" class="btn btn-primary">Next <span class="fa fa-chevron-circle-right"></span> </a>

        </div>


    </div>

</div>




<?php
include 'includes/emptyLayoutBottom.inc.php';
?>

