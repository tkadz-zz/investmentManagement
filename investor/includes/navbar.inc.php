<?php
if (isset($_GET['logout']) && ($_GET['logout'] == 'true')) {
    $newlogout = new Usercontr();
    $newlogout->log_out();

}

?>

<!-- partial:partials/_navbar.html -->
<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
        </div>
        <div>
            <a class="navbar-brand brand-logo" href="index.php">
                <img src=""/>
            </a>
            <a class="navbar-brand brand-logo-mini" href="index.php">
                <img src=""/>
            </a>
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-top">
        <ul class="navbar-nav">
            <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                <h1 class="welcome-text">Hie, <span class="text-black fw-bold"> <?php echo $_SESSION['name'] ?></span></h1>
                <h6 class="welcome-sub-text" style="font-size: 15px"><?php echo strtoupper($_SESSION['role']) .'('. $_SESSION['name'] .' '. $_SESSION['surname'].')' ?> </h6>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
<!--
            <?php
/*                $var = new StudentView();
                $var->attachmentStatus($_SESSION['id']);
            */?>

-->

<!--            <li class="nav-item d-none d-lg-block">
                <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
              <span class="input-group-addon input-group-prepend border-right">
                <span class="icon-calendar input-group-text calendar-icon"></span>
              </span>
                    <input type="text" class="form-control">
                </div>
            </li>--><!--
            <li class="nav-item">
                <form class="search-form" action="#">
                    <i class="icon-search"></i>
                    <input type="search" class="form-control" placeholder="Search Here" title="Search here">
                </form>
            </li>-->

            <?php
            $defContr = new Usercontr();
            $msgCount = $defContr->GetActiveUserMail($_SESSION['id']);
            ?>
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                    <i class="icon-mail icon-lg"></i>
                    <?php
                    if(count($msgCount) > 0){
                        ?>
                        <span class="count"></span>
                        <?php
                    }
                    ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="notificationDropdown">
                    <a href="allmessages.php" class="dropdown-item py-3 border-bottom">
                        <p class="mb-0 font-weight-medium float-left">You have
                            <?= count($msgCount); ?>
                            New Mail </p>
                        <span class="badge badge-pill badge-primary float-right">View all</span>
                    </a>
                </div>
            </li>



            <!--<li class="nav-item dropdown">
                <a class="nav-link count-indicator" id="countDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="icon-bell"></i>
                    <span class="count"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="countDropdown">
                    <a class="dropdown-item py-3">
                        <p class="mb-0 font-weight-medium float-left">You have 0 unread Notifications </p>
                        <span class="badge badge-pill badge-primary float-right">View all</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <img src="images/faces/face10.jpg" alt="image" class="img-sm profile-pic">
                        </div>
                        <div class="preview-item-content flex-grow py-2">
                            <p class="preview-subject ellipsis font-weight-medium text-dark">0 Notifications </p>
                            <p class="fw-light small-text mb-0"> Notifications will appear here </p>
                        </div>
                    </a>

                </div>-->
            </li>
            <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="img-xs rounded-circle" src="../avatar/undraw_profile.svg" alt="Profile image"> </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <div class="dropdown-header text-center">
                        <img class="img-md rounded-circle" src="../avatar/undraw_profile.svg" alt="Profile image">
                        <p class="mb-1 mt-3 font-weight-semibold"><?php echo $_SESSION['name'] .' '. $_SESSION['surname'] ?></p>
                        <p class="fw-light text-muted mb-0">Details</p>
                    </div>

                    <a class="dropdown-item" href="profile.php"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile</a>
                    <!--<a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-message-text-outline text-primary me-2"></i> Messages</a>
                    <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-calendar-check-outline text-primary me-2"></i> Activity</a>
                    <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i> FAQ</a>-->
                    <a class="dropdown-item" href="?logout=true"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
<!-- partial -->