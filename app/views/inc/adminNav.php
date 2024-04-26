<nav>
    <div class="logo-name">
        <div class="logo-image">
            <img src="<?php echo URLROOT; ?>/auth/logo.png" alt="">
        </div>
        <span class="logo_name">EduPick</span>
    </div>
    <div class="menu-items">
        <ul class="nav-links">
            <li><a href="<?php echo URLROOT; ?>/admins/adminDashboard">
                <i class="uil uil-estate"></i>
                <span class="link-name">Dashboard</span>
            </a></li>
            <li><a href="<?php echo URLROOT; ?>/admins/manageAdmins">
                <i class="uil uil-estate"></i>
                <span class="link-name">Manage Admins</span>
            </a></li>
            <li><a href="<?php echo URLROOT; ?>/admins/vehicleApproval">
                <i class="uil uil-bus-school"></i>
                <span class="link-name">Approve Vehicles</span>
            </a></li>
            <li><a href="<?php echo URLROOT; ?>/admins/driverApproval">
                <i class="uil uil-user-circle"></i>
                <span class="link-name">Approve Drivers</span>
            </a></li>
            <li><a href="<?php echo URLROOT; ?>/users/adminRegister">
                <i class="uil uil-sign-in-alt"></i>
                <span class="link-name">Admin Registration</span>
            </a></li>
        </ul>
        
        <ul class="logout-mode">
            <li><a href="<?php echo URLROOT; ?>/users/logout">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>
            <li class="mode">
                <a href="#">
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
            <h2>Hi,
                <?php echo $_SESSION['user_fname']; ?>
            </h2>
        </div>
    </div>