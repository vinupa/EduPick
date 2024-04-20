<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/driver/style.css" />
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
                <i class="uil uil-tachometer-fast-alt"></i>
                <span class="text">Dashboard</span>
            </div>

        </div>

        <div class="activity">
            <h1>Driver Dashboard</h1>
        </div>
    </div>
    </section>

    <script src="<?php echo URLROOT; ?>/driver/script.js"></script>

    <?php require APPROOT . '/views/inc/footer.php'; ?>