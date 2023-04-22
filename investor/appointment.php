<?php
include 'includes/emptyLayoutTop.inc.php';
include 'includes/miniTab.inc.php';
?>
    <div class="container mt-4 mb-4">
        <div class="btn btn-outline-secondary btn-sm rounded text-decoration-none" data-size="large"><a href="javascript:history.back()" class="fb-xfbml-parse-ignore"><span class="fa fa-chevron-circle-left"></span> Back</a></div>
        <br>
        <br>



    <br>

    <div id="--printableArea" class="card-box">
        <h4 class="mt-0 header-title"></h4>
        <p class="text-muted font-14 mb-3">
            All Appointments
        </p>
        <table id="datatable" class="table table-bordered dt-responsive nowrap">

            <thead>
            <tr>
                <th>#</th>
                <th>Patient</th>
                <th>Doctor</th>
                <th>Appointment ID</th>
                <th>Appointment Date</th>
            </tr>
            </thead>

            <tbody>
            <?php
            $n = new Userview();
            $n->viewDoctorAppointmentsLoop($_SESSION['id']);
            ?>
            </tbody>


        </table>
    </div>


</div>


<?php
include 'includes/emptyLayoutBottom.inc.php';
?>