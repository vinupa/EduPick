<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/owner/style.css" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/owner/manageVehiclesStyle.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<title>
    <?php echo SITENAME; ?> | Registry
</title>
</head>

<body>

    <?php require APPROOT . '/views/inc/ownerNav.php'; ?>

    <div class="dash-content">
        <div class="overview">
            <div class="title">
                <i class="uil uil-clipboard-notes"></i>
                <span class="text">Registry</span>
            </div>
        </div>

        <div class="activity">

            <div class="activity-data">

                <div class="data email">
                    <span class="data-title">Child Name</span>
                    <?php foreach ($data['children'] as $child): ?>
                        <span class="data-list">
                            <?php echo $child->firstName; ?>&nbsp;<?php echo $child->lastName; ?>
                        </span>
                    <?php endforeach; ?>
                </div>

                <div class="data joined">
                    <span class="data-title">School</span>
                    <?php foreach ($data['children'] as $child): ?>
                        <span class="data-list">
                            <?php echo $child->schoolName; ?>
                        </span>
                    <?php endforeach; ?>
                </div>

                <div class="data type">
                    <span class="data-title">Grade</span>
                    <?php foreach ($data['children'] as $child): ?>
                        <span class="data-list">
                            <?php echo $child->grade; ?>
                        </span>
                    <?php endforeach; ?>
                </div>

                <div class="data type">
                    <span class="data-title">Hometown</span>
                    <?php foreach ($data['children'] as $child): ?>
                        <span class="data-list">
                            <?php echo $child->city; ?>
                        </span>
                    <?php endforeach; ?>
                </div>

                <div class="data type">
                    <span class="data-title">Parent Contact</span>
                    <?php foreach ($data['children'] as $child): ?>
                        <span class="data-list">
                            <?php echo $child->contactNumber; ?>
                        </span>
                    <?php endforeach; ?>
                </div>

                <div class="data status">
                    <span class="data-title">Connection</span>
                    <?php foreach ($data['children'] as $child): ?>
                        <span class="data-list">
                            <a href="<?php echo URLROOT; ?>/owners/disconnectChild/<?php echo $child->childID; ?>" onclick="return confirm('Are you sure you want to disconnect the child?');" class="disconnect-btn">
                                <i class="uil uil-link-broken"></i>
                            </a>
                        </span>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>
    </section>

    <script src="<?php echo URLROOT; ?>/owner/script.js"></script>

    <?php require APPROOT . '/views/inc/footer.php'; ?>