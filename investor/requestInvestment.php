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
    <div class="row">

        <div class="col-md-6">
            <div class="card-box -card">
                <div class="card-header">
                    <div class="h4"> Request Investment Form</div>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <form class="form-group" method="POST" action="includes/addDocs.inc.php?iuID=<?php echo $_GET['iuID'] ?>" enctype="multipart/form-data">

                            <h5>Upload Necessary Documents Here</h5>
                            <hr>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label>Title</label>
                                    <input class="form-control" type="text" name="title" placeholder="Document Title..." required>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <label>Document Description</label>
                                    <textarea style="height: 150px" class="form-control" name="description" placeholder="Add Document Description or Additional Details..." required></textarea>
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
            $n->viewDocLoop($_GET['iuID'], $_SESSION['id'])
            ?>
        </div>


        <div>
            <br>
            <label style="font-size: 12px" class="card-description">Press next after you are done uploading documents</label>
            <br>
            <a href="includes/finilize.inc.php?iuID=<?php echo $_GET['iuID'] ?>" class="btn btn-primary">Next <span class="fa fa-chevron-circle-right"></span> </a>

        </div>


    </div>

</div>




<?php
include 'includes/emptyLayoutBottom.inc.php';
?>

