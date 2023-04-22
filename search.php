<?php include('dashboard_empty_layout_top.inc.php') ?>
<?php include_once 'includes/checkIfAdmin.inc.php'?>

<div -class="container">

    <!-- Breadcrumb -->
    <nav -aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
            <li -class="breadcrumb-item"><a class="btn -btn-outline-secondary" href="admin.php" > <span class="fa fa-home"></span> Dashboard</a></li>
            <li -class="breadcrumb-item"><a class="btn -btn-outline-secondary" href="#!" onclick="goBack()"> <span class="fa fa-chevron-circle-left"></span> Back</a></li>
        </ol>
    </nav>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Search Results For "<u><?php echo $_GET['search'] ?></u>"</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Joined</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Edit</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    if(isset($_GET['search'])) {
                        $search = new Userview();
                        $search->AdminSearch($_GET['search']);
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>









<?php include('dashboard_empty_layout_bottom.inc.php') ?>
