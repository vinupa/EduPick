<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/owner/style.css" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/owner/manageVehiclesStyle.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<title>
    <?php echo SITENAME; ?> | View Parents
</title>
</head>

<body>

    <?php require APPROOT . '/views/inc/ownerNav.php'; ?>

    <div class="dash-content">
        <div class="overview">
            <div class="title">
                <i class="uil uil-eye"></i>
                <span class="text">View Parents</span>
            </div>
        </div>

        <div class="activity">

            <div class="activity-data">

                <div class="data joined">
                    <span class="data-title">Parent Name</span>
                    <?php foreach ($data['parents'] as $parent): ?>
                        <span class="data-list data-grade">
                            <?php echo $parent->firstName; ?>
                        </span>
                    <?php endforeach; ?>
                </div>


                <div class="data joined">
                    <span class="data-title">Child Name</span>
                    <?php foreach ($data['parents'] as $parent): ?>
                        <span class="data-list data-grade">
                            <?php echo $parent->childFirstName; ?>
                        </span>
                    <?php endforeach; ?>
                </div>

                <div class="data joined">
                    <span class="data-title">School</span>
                    <?php foreach ($data['parents'] as $parent): ?>
                        <span class="data-list data-grade">
                            <?php echo $parent->school; ?>
                        </span>
                    <?php endforeach; ?>
                </div>
                

                <div class="data joined">
                    <span class="data-title">Contact Number</span>
                    <?php foreach ($data['parents'] as $parent): ?>
                        <span class="data-list data-grade">
                            <?php echo $parent->contactNumber; ?>
                        </span>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>
    </section>

    <script src="<?php echo URLROOT; ?>/owner/script.js"></script>

    <?php require APPROOT . '/views/inc/footer.php'; ?>