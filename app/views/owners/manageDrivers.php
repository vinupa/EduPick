<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/owner/style.css" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/owner/manageVehiclesStyle.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<title>
    <?php echo SITENAME; ?> | Manage Drivers
</title>
</head>

<body>

    <?php require APPROOT . '/views/inc/ownerNav.php'; ?>

    <div class="dash-content">
        <div class="overview">
            <div class="title">
                <i class="uil uil-car-sideview"></i>
                <span class="text">Manage Drivers</span>
            </div>
        </div>

        <div class="activity">

            <div class="activity-data">

                <div class="data names">
                    <span class="data-title">Driver</span>
                    <?php foreach ($data['drivers'] as $driver): ?>
                        <span class="data-list">
                            <img src="<?php echo URLROOT; ?>/uploads/<?php echo $driver->image_profilePhoto; ?>" alt="driver photo" class="vehicle-image">
                        </span>
                    <?php endforeach; ?>
                </div>

                <div class="data email">
                    <span class="data-title">Name</span>
                    <?php foreach ($data['drivers'] as $driver): ?>
                        <span class="data-list">
                            <?php echo $driver->firstName; ?>&nbsp;<?php echo $driver->lastName; ?>
                        </span>
                    <?php endforeach; ?>
                </div>

                <div class="data joined">
                    <span class="data-title">Contact Number</span>
                    <?php foreach ($data['drivers'] as $driver): ?>
                        <span class="data-list">
                            <?php echo $driver->contactNumber; ?>
                        </span>
                    <?php endforeach; ?>
                </div>

                <div class="data type">
                    <span class="data-title">Vehicle</span>
                    <?php foreach ($data['drivers'] as $driver): ?>
                        <span class="data-list">
                            <?php echo $driver->licensePlate; ?>
                        </span>
                    <?php endforeach; ?>
                </div>

                <div class="data status">
                    <span class="data-title">Connection</span>
                    <?php foreach ($data['drivers'] as $driver): ?>
                        <span class="data-list">
                            <a href="<?php echo URLROOT; ?>/owners/disconnectDriver/<?php echo $driver->driverID; ?>" onclick="return confirm('Are you sure you want to disconnect the driver?');" class="disconnect-btn">
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