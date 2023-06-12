<?php
include 'includes/emptyLayoutTop.inc.php';
?>

<?php
include 'includes/miniTab.inc.php';
?>

<style xmlns="http://www.w3.org/1999/html">
    @media print {
        .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
            float: left;
        }
        .col-sm-12 {
            width: 100%;
        }
        .col-sm-11 {
            width: 91.66666667%;
        }
        .col-sm-10 {
            width: 83.33333333%;
        }
        .col-sm-9 {
            width: 75%;
        }
        .col-sm-8 {
            width: 66.66666667%;
        }
        .col-sm-7 {
            width: 58.33333333%;
        }
        .col-sm-6 {
            width: 50%;
        }
        .col-sm-5 {
            width: 41.66666667%;
        }
        .col-sm-4 {
            width: 33.33333333%;
        }
        .col-sm-3 {
            width: 25%;
        }
        .col-sm-2 {
            width: 16.66666667%;
        }
        .col-sm-1 {
            width: 8.33333333%;
        }



    }
</style>

<div class="mt-4 mb-4">
    <div class="row">
        <div class="col-12">

            <!--<a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>-->
            <button onclick="printDiv('printableArea')" class="btn btn-otline-dark"><i class="icon-printer"> Print</i></button>
            <div id="printableArea" class="card-box">
                <h4 class="mt-0 header-title"></h4>
                <p class="text-muted font-14 mb-3">
                    Information Systems Students - 4.1 - 2022
                </p>
                <div style="font-size: 12px">
                    <span class="mdi mdi-human-female text-primary"></span> Female<br>
                    <span style="color: yellow" class="mdi mdi-human-male text-primary"></span> Male<br>
                    <span class="mdi mdi-exclamation text-primary"></span> Not Specified
                </div>
                <table style="font-size: 12px" -id="datatable" class="table table-bordered -dt-responsive nowrap shadow-sm">

                    <tthead>
                    <tr>
                        <th>#</th>
                        <th>Reg-Number</th>
                        <th>Sex - Name - Surname</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </tr>
                    </tthead>

                    <tbody style="font-size: 11px">
                    <?php
                    $student = 'student';
                    $n = new StudentView();
                    $n->ViewAllStudentsPrint($student);
                    ?>
                    </tbody>


                </table>

            </div>

            <script>
                function printDiv(divName) {
                    var printContents = document.getElementById(divName).innerHTML;
                    var originalContents = document.body.innerHTML;

                    document.body.innerHTML = printContents;

                    window.print();

                    document.body.innerHTML = originalContents;
                }
            </script>

        </div>


    </div>
</div>





<?php
include 'includes/emptyLayoutBottom.inc.php';
?>

