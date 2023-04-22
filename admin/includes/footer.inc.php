
<!-- ADD Investment Modal -->
<div class="modal fade" id="addInvestmentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <?php
                $n = new Userview();
                $random = $n->viewRandomString(12);
                ?>

                <h5 class="modal-title" id="exampleModalLabel">Add New Investment: <?php echo $random ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="includes/dbAdd.inc.php">
                <div class="modal-body">

                    <input type="text" name="uiID" hidden value="<?php echo $random ?>">

                    <div class="form-group col-md-6">
                        <label for="inputEmail4" -class="col-form-label">Investment Name</label>
                        <input name="name" type="text" class="form-control" placeholder="Name of company or Investment Title" required>
                    </div>

                    <div class="form-row row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4" -class="col-form-label">Investment Category</label>
                            <input name="category" type="text" class="form-control" placeholder="e.g Fashion, Retails, IT, Trading, Transport, Wholesale..." required>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4" -class="col-form-label">Investment Type</label>
                                <select class="form-control" name="type" required>
                                    <option value="">-- SELECT INVESTMENT TYPE --</option>
                                    <option value="short">SHORT TERM INVESTMENT</option>
                                    <option value="medium">MEDIUM TERM INVESTMENT</option>
                                    <option value="long">LONG TERM INVESTMENT</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label  -class="col-form-label">Investment Description</label>
                                <textarea name="description" type="text" class="form-control" placeholder="Investment description that will be shown to the investors"style="height: 200px" required></textarea>
                            </div>

                            <div class="form-group col-md-5">
                                <label  -class="col-form-label">Investments Limits</label>
                                <table -id="datatable" class="table -table-bordered -dt-responsive -nowrap">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Short Term</th>
                                            <th>Medium Term</th>
                                            <th>Long Term</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td>$1000-$5000</td>
                                            <td>$6000-$12000</td>
                                            <td>$13000-$25000</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Profit R</strong></td>
                                            <td>10% / 3 months <span class="mdi mdi-arrow-up"></span></td>
                                            <td>20% / 6 months <span class="mdi mdi-arrow-up"></span></td>
                                            <td>30% / 1 year <span class="mdi mdi-arrow-up"></span></td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button name="btn_addInvstment" type="submit"  class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End add Investment -->






<!-- ADD USER Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="includes/addUser.inc.php">
            <div class="modal-body">

                <div class="form-group col-md-6">
                    <label for="inputEmail4" class="col-form-label">LoginID</label>
                    <input name="loginID" type="text" class="form-control" placeholder="Loggin ID" pattern=".{5,20}" required title="5 to 12 characters">
                </div>

                    <div class="form-row row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4" class="col-form-label">Name</label>
                            <input name="name" type="text" class="form-control" placeholder="User First Name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label  class="col-form-label">Surname</label>
                            <input name="surname" type="text" class="form-control" placeholder="User Surname" value="" -pattern=".{5,12}" required -title="5 to 12 characters" >
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4" class="col-form-label">User Type</label>
                            <select class="form-control" name="userType" required>
                                <option value="">-- SELECT USER ROLE --</option>
                                    <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>
                <span>Note: Password will be set when the user wants to login</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button name="btn_addUser" type="submit"  class="btn btn-primary">Save changes</button>
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