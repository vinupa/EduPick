<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/driver/style.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<title>
    <?php echo SITENAME; ?> | Driver Registration
</title>
</head>

<body>

    <?php require APPROOT . '/views/inc/driverPendingNav.php'; ?>

    <div class="dash-content">
        <div class="overview">
            <div class="title">
                <i class="uil uil-stopwatch"></i>
                <span class="text">Pending Approval</span>
            </div>

            <div class="pending-message">
                <i class="uil uil-info-circle"></i>
                <span class="text">You have succcessfully submitted your verification details and your driver registration is currently pending approval. <br>Please wait for the admin to verify your details. This can take up to two working days. <br>Your patience is highly appreciated!</span>
            </div>

        </div>

    </div>

    <!-- <img src="<?php //echo URLROOT; ?>/uploads/driver\profilePhoto\6623536cb39018.06674227.jpg" alt="pending approval" class="pending-img">
    <embed src="<?php //echo URLROOT; ?>/uploads/driver\policeReport\6623536cb44af8.86251921.pdf" width="500px" height="650px" /> -->

    </section>

    <script src="<?php echo URLROOT; ?>/driver/script.js"></script>

    <?php require APPROOT . '/views/inc/footer.php'; ?>