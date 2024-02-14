<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/parent/style.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<title>
    <?php echo SITENAME; ?> | Update Child
</title>
</head>

<body>
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
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Dashboard</span>
                    </a></li>
                <li><a href="#">
                        <i class="uil uil-search"></i>
                        <span class="link-name">Search Vehicles</span>
                    </a></li>
                <li><a href="#">
                        <i class="uil uil-chart"></i>
                        <span class="link-name">Manage Vehicles</span>
                    </a></li>
                <li><a href="#">
                        <i class="uil uil-bus-school"></i>
                        <span class="link-name">View Vehicles</span>
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

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-edit"></i>
                    <span class="text">Update Child Details</span>
                </div>
            </div>

            <div class="goback-link">
                <a href="<?php echo URLROOT; ?>/parents/manageChildren">
                    <i class="uil uil-backward"></i>
                    <span class="text">Back to Dashboard</span>
                </a>
            </div>

            <div class="add-child">
                <form action="<?php echo URLROOT; ?>/parents/updateChildPost" method="POST">
                    <div class="input-box">
                        <span class="details">First Name</span>
                        <input type="text" id="first_name" name="first_name" value="<?php echo $data['firstName'] ?>">
                    </div>
                    <div class="input-box">
                        <span class="details">Last Name</span>
                        <input type="text" id="last_name" name="last_name" value="<?php echo $data['lastName'] ?>">
                    </div>
                    <div class="input-box">
                        <span class="details">School</span>
                        <select class="" id="school" name="school">
                            <option value="" disabled hidden selected>Select School</option>
                            <option value="Royal College, Colombo" <?php echo ($data['school'] == 'Royal College, Colombo') ? 'selected' : ''?>>Royal College, Colombo</option>
                            <option value="Ananda College, Colombo" <?php echo ($data['school'] == 'Ananda College, Colombo') ? 'selected' : ''?>>Ananda College, Colombo</option>
                            <option value="Thurstan College, Colombo" <?php echo ($data['school'] == 'Thurstan College, Colombo') ? 'selected' : ''?>>Thurstan College, Colombo</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">Grade</span>
                        <input type="number" id="grade" name="grade" value="<?php echo $data['grade'] ?>">
                    </div>

                    <input type="hidden" name="child_id" value="<?php echo $data['child_id'] ?>">
                    
                    <!-- error messages -->
                    <div class="auth-err">
                        <p> <?php echo $data['firstName_err']; ?></p>
                        <p> <?php echo $data['lastName_err']; ?></p>
                        <p> <?php echo $data['school_err']; ?></p>
                        <p> <?php echo $data['grade_err']; ?></p>
                      </div>
                    <div class="submit-button">
                        <input type="submit" value="Update">
                    </div>
                </form>
        </div>
    </section>

    <script src="<?php echo URLROOT; ?>/parent/script.js"></script>

    <?php require APPROOT . '/views/inc/footer.php'; ?>