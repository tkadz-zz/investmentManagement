

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">

        <li class="nav-item nav-category">My Class Tabs</li>
        <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
                <i class="menu-icon mdi mdi-view-dashboard"></i>
                <span class="menu-title">Dashboard</span>
                <i class="menu-arrow"></i>
            </a>
        </li>
        <li class="nav-item nav-category">Profile and Security</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                <i class="menu-icon mdi mdi-account-edit"></i>
                <span class="menu-title">Manage Profile</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="password.php">Password</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item nav-category">help</li>
        <li class="nav-item">
            <a class="nav-link" href="../unauthorized.php">
                <i class="menu-icon mdi mdi-file-document"></i>
                <span class="menu-title">Documentation</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="?logout=true">
                <i class="menu-icon mdi mdi-power"></i>
                <span class="menu-title">Sign Out</span>
            </a>
        </li>
    </ul>
</nav>