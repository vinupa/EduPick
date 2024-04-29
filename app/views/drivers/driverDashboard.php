<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/driver/style.css" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/driver/driverDashboardStyles.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<title>
    <?php echo SITENAME; ?> | Dashboard
</title>
</head>

<body>

    <?php require APPROOT . '/views/inc/driverNav.php'; ?>

    <div class="dash-content">
        <div class="overview">
            <div class="title">
                <i class="uil uil-chart"></i>
                <span class="text">Dashboard</span>
            </div>

        </div>

        <div class="activity">

            <div class="subtopic">
                <i class="uil uil-clipboard"></i>
                <span class="text">Child Attendance</span>
            </div>

            <div class="activity-data">

                <div class="data names">
                    <span class="data-title">Child Name</span>
                    <?php foreach ($data['children'] as $child) : ?>
                        <span class="data-list">
                            <?php echo $child->firstName; ?>&nbsp;<?php echo $child->lastName; ?>
                        </span>
                    <?php endforeach; ?>
                </div>

                <div class="data email">
                    <span class="data-title">Grade</span>
                    <?php foreach ($data['children'] as $child) : ?>
                        <span class="data-list">
                            <?php echo $child->grade; ?>
                        </span>
                    <?php endforeach; ?>
                </div>

                <div class="data joined">
                    <span class="data-title">School</span>
                    <?php foreach ($data['children'] as $child) : ?>
                        <span class="data-list data-grade">
                            <?php echo $child->schoolName; ?>
                        </span>
                    <?php endforeach; ?>
                </div>

                <div class="data status">
                    <span class="data-title">Attendance</span>
                    <?php foreach ($data['children'] as $child) : ?>
                        <span class="data-list">
                            <?php if ($child->absentState == 1) : ?>
                                <span style="color: rgb(255, 0, 0);"><i class="uil uil-times-circle"></i>&nbsp;Absent</span>
                            <?php else : ?>
                                <span style="color: rgb(18, 207, 18);"><i class="uil uil-check-circle"></i>&nbsp;Attending</span>
                            <?php endif; ?>
                        </span>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>
    </section>

    <script src="<?php echo URLROOT; ?>/driver/script.js"></script>

    <?php require APPROOT . '/views/inc/footer.php'; ?>