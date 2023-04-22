<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#!">
                <div class="sidebar-brand-icon rotate-n-15">
                </div>
                <div class="sidebar-brand-text mx-3">
                <img class="" height="30" src="images/signin-header-image"></img> HMS
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

    <?php
    if($_SESSION['role'] == 'company')
    {
    ?>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="settings.php">
                    <i class="fa fa-fw fa-cog"></i>
                    <span>Settings</span></a>
            </li>
    <?php
    }
    elseif($_SESSION['role'] == 'admin')
    {
    ?>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="admin.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="settings.php">
            <i class="fa fa-fw fa-cog"></i>
            <span>Settings</span></a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="industry.php">
            <i class="fa fa-fw fa-industry"></i>
            <span>Manage Industry</span></a>
    </li>
    <?php
    }
    ?>
            <!-- Divider -->
            <hr class="sidebar-divider">






            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


            <!--
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
            </div>
            -->

        </ul>