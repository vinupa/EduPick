<nav>
    <div class="logo-name">
        <div class="logo-image">
            <img src="<?php echo URLROOT; ?>/auth/logo.png" alt="">
        </div>

        <span class="logo_name">EduPick</span>
    </div>

    <div class="menu-items">

        <div class="intro-content">
            Thank you for choosing <b>EduPick</b>, the trusted School Transport Management System. Please fill in the given form to get verified as a driver on the platform. Make sure to submit accurate proof documents to ensure a smooth verification process.
        </div>

        <ul class="nav-links">
            <!-- <li><a href="#">
                    <i>&nbsp;</i>
                    <span class="link-name">Welcome</span>
                </a></li> -->
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