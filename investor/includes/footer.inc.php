<!-- Invest Modal -->
<div class="modal fade" id="investModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full -modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Investment Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $n = new Userview();
            $n->viewInvestmentForm($_GET['iuID']);
            ?>
        </div>
    </div>
</div>


<!-- Terminate Investment Modal  -->
<div class="modal fade" id="terminateInvst" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full -modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Investment Termination Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="includes/terminateInv.inc.php">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input name="iuID" value="<?php echo $_GET['iuID'] ?>" hidden>
                            <span style="font-size: 14px">This Investment with Investment-ID <strong><?php echo $_GET['iuID'] ?></strong>  will be terminated </span>
                            <br>
                            <br>
                            <h3 class="text-center">Continue ?</h3>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                    <button name="btn_teminate" type="submit"  class="btn btn-primary">YES</button>
                </div>
            </form>
        </div>
    </div>
</div>







<footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash.</span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All rights reserved.</span>
    </div>
</footer>
<!-- page-body-wrapper ends -->
</div>




<!-- plugins:js -->
<script src="../UniversalUsersDashboardStyles/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="../UniversalUsersDashboardStyles/vendors/chart.js/Chart.min.js"></script>
<script src="../UniversalUsersDashboardStyles/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="../UniversalUsersDashboardStyles/vendors/progressbar.js/progressbar.min.js"></script>

<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="../UniversalUsersDashboardStyles/js/off-canvas.js"></script>
<script src="../UniversalUsersDashboardStyles/js/hoverable-collapse.js"></script>
<script src="../UniversalUsersDashboardStyles/js/template.js"></script>
<script src="../UniversalUsersDashboardStyles/js/settings.js"></script>
<script src="../UniversalUsersDashboardStyles/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="../UniversalUsersDashboardStyles/js/dashboard.js"></script>
<script src="../UniversalUsersDashboardStyles/js/Chart.roundedBarCharts.js"></script>
<!-- End custom js for this page-->




<!-- third party js -->
<script src="../assets/libs/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/libs/datatables/dataTables.bootstrap4.js"></script>
<script src="../assets/libs/datatables/dataTables.responsive.min.js"></script>
<script src="../assets/libs/datatables/responsive.bootstrap4.min.js"></script>
<script src="../assets/libs/datatables/dataTables.buttons.min.js"></script>
<script src="../assets/libs/datatables/buttons.bootstrap4.min.js"></script>
<script src="../assets/libs/datatables/buttons.html5.min.js"></script>
<script src="../assets/libs/datatables/buttons.flash.min.js"></script>
<script src="../assets/libs/datatables/buttons.print.min.js"></script>
<script src="../assets/libs/datatables/dataTables.keyTable.min.js"></script>
<script src="../assets/libs/datatables/dataTables.select.min.js"></script>
<script src="../assets/libs/pdfmake/pdfmake.min.js"></script>
<script src="../assets/libs/pdfmake/vfs_fonts.js"></script>
<!-- third party js ends -->

<!-- Datatables init -->
<script src="../assets/js/pages/datatables.init.js"></script>

<!-- Vendor js -->
<script src="assets/js/vendor.min.js"></script>

<!-- knob plugin -->
<script src="assets/libs/jquery-knob/jquery.knob.min.js"></script>

<!--Morris Chart-->
<script src="assets/libs/morris-js/morris.min.js"></script>
<script src="assets/libs/raphael/raphael.min.js"></script>

<!-- Dashboard init js-->
<script src="assets/js/pages/dashboard.init.js"></script>

<!-- App js -->
<script src="assets/js/app.min.js"></script>

</body>

</html>

<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
?>