<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/admin-dashboard/style.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
<title>Admin Dashboard Panel</title> 
</head>
<body>
    <?php require APPROOT . '/views/inc/adminNav.php'; ?>
    <div class="dash-content">
        <div class="overview">
            <div class="title">
                <i class="uil uil-tachometer-fast-alt"></i>
                <span class="text">Manage Children</span>
            </div>
            <div class="boxes">
                <a href="">
                    <div class="box box1">
                        <i class="uil uil-plus-circle"></i>
                        <span class="text">Add Child</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    </section>
    <script src="<?php echo URLROOT; ?>/parent/script.js"></script>
    <?php require APPROOT . '/views/inc/footer.php'; ?>