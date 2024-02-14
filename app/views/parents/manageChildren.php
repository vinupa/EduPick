<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/parent/style.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<title>
    <?php echo SITENAME; ?> | Manage Children
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
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Dashboard</span>
                </div>

                <div class="boxes">
                    <a href="<?php echo URLROOT; ?>/parents/addChild">
                        <div class="box box1">
                            <i class="uil uil-plus-circle"></i>
                            <span class="text">Add Child</span>
                        </div>
                    </a>
                </div>
            </div>

            <div class="activity">

                <div class="activity-data">

                    <div class="data names">
                        <span class="data-title">Child Name</span>
                        <?php foreach ($data['children'] as $child): ?>
                            <span class="data-list">
                                <?php echo $child->firstName; ?>
                                <?php echo $child->lastName; ?>
                            </span>
                        <?php endforeach; ?>
                    </div>

                    <div class="data email">
                        <span class="data-title">School</span>
                        <?php foreach ($data['children'] as $child): ?>
                            <span class="data-list">
                                <?php echo $child->school; ?>
                            </span>
                        <?php endforeach; ?>
                    </div>

                    <div class="data joined">
                        <span class="data-title">Grade</span>
                        <?php foreach ($data['children'] as $child): ?>
                            <span class="data-list data-grade">
                                <?php echo $child->grade; ?>
                            </span>
                        <?php endforeach; ?>
                    </div>

                    <div class="data type">
                        <span class="data-title">Vehicle Owner</span>
                        <?php foreach ($data['children'] as $child): ?>
                            <span class="data-list">
                                <?php echo $child->vanID; ?>
                            </span>
                        <?php endforeach; ?>
                    </div>

                    <div class="data status">
                        <span class="data-title">Vehicle Driver</span>
                        <?php foreach ($data['children'] as $child): ?>
                            <span class="data-list">
                                <?php echo $child->vanID; ?>
                            </span>
                        <?php endforeach; ?>
                    </div>

                    <div class="data icons">
                        <span class="data-title">Delete/Edit</span>
                        <?php foreach ($data['children'] as $child): ?>
                            <span class="data-list">
                                <div class="delete-edit-icons">
                                    <a href="<?php echo URLROOT; ?>/parents/removeChild/<?php echo $child->childID; ?>"><i
                                            class="uil uil-trash-alt"></i></a>
                                    <a href="<?php echo URLROOT; ?>/parents/updateChild/<?php echo $child->childID; ?>"><i
                                            class="uil uil-edit"></i></a>
                                </div>
                            </span>
                        <?php endforeach; ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="<?php echo URLROOT; ?>/parent/script.js"></script>

    <?php require APPROOT . '/views/inc/footer.php'; ?>