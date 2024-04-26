<nav>
    <div class="logo-name">
        <div class="logo-image">
            <img src="<?php echo URLROOT; ?>/auth/logo.png" alt="">
        </div>

        <span class="logo_name">EduPick</span>
    </div>

    <div class="menu-items">
        <ul class="nav-links">
            <li><a href="<?php echo URLROOT; ?>/parents/index">
                    <i class="uil uil-users-alt"></i>
                    <span class="link-name">Manage Children</span>
                </a></li>
            <li><a href="<?php echo URLROOT; ?>/parents/selectChild">
                    <i class="uil uil-search"></i>
                    <span class="link-name">Find Vehicles</span>
                </a></li>
            <li><a href="<?php echo URLROOT; ?>/parents/manageVehicles">
                    <i class="uil uil-chart"></i>
                    <span class="link-name">Manage Vehicles</span>
                </a></li>
            <li><a href="<?php echo URLROOT; ?>/parents/incidentReports">
                    <i class="uil uil-exclamation-octagon"></i>
                    <span class="link-name">Report Incident</span>
                </a></li>
        </ul>

        <ul class="logout-mode">
            <li><a href="<?php echo URLROOT; ?>/users/logout">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>

            <li class="mode">
                <a>
                    <i class="uil uil-moon"></i>
                    <span class="link-name">Dark Mode</span>
                </a>

                <div class="mode-toggle">
                    <span class="switch"></span>
                </div>
            </li>
        </ul>
    </div>
</nav>

<section class="dashboard">
    <div class="top">
        <i class="uil uil-bars sidebar-toggle"></i>
        <div class="user-profile">
            <i class="uil uil-user-circle"></i>
            <h2>Hi,
                <?php echo $_SESSION['user_fname']; ?>
            </h2>
        </div>
    </div>