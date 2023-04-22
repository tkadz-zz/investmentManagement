<?php include('dashboard_empty_layout_top.inc.php') ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"> <span class="fa fa-wrench"></span> Settings</h6>
    </div>
</div>


<div class="card shadow mb-4">
    <div class="card-header py-3" style="font-size: 20px">
        <?php include('includes/error_report.inc.php') ?>
    </div>
</div>


<div class="card mb-4 py-3 border-left-secondary">
    <div class="card-body">
        <h4>Change Password</h4>
        <hr>


        <form method="POST" action="includes/updatePassword.inc.php">
            <div class="form-group">
                <label for="exampleInputPassword1">Old Password</label>
                <input type="password" name="old_password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <br>

            <div class="form-group">
                <label for="exampleInputPassword1">New Password</label>
                <input type="password" name="new_password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>


            <button type="submit" class="btn btn-primary">Update</button>
        </form>

    </div>
</div>











<?php include('dashboard_empty_layout_bottom.inc.php') ?>
