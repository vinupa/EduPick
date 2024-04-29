<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/driver/style.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<title>
    <?php echo SITENAME; ?> | Driver Rejected
</title>
</head>

<body>

    <?php require APPROOT . '/views/inc/driverPendingNav.php'; ?>

    <div class="dash-content">
        <div class="overview">
            <div class="title">
                <i class="uil uil-exclamation-triangle"></i>
                <span class="text">Application Rejected</span>
            </div>

            <div class="pending-message">
                <i class="uil uil-info-circle"></i>
                <span class="text">We are sorry to inform you that your application to get verified as driver on the EduPick platform has unfortunately not met our criteria and has been rejected. Please reach out to the Administrators if you think that this may be a mistake.</span>
            </div>

        </div>

    </div>
    </section>

    <script src="<?php echo URLROOT; ?>/driver/script.js"></script>

    <?php require APPROOT . '/views/inc/footer.php'; ?>