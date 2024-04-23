<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/owner/style.css" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/owner/manageVehiclesStyle.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<title>
    <?php echo SITENAME; ?> | Manage Vehicles
</title>
</head>

<body>

    <?php require APPROOT . '/views/inc/ownerNav.php'; ?>

    <div class="dash-content">
        <div class="overview">
            <div class="title">
                <i class="uil uil-bus-school"></i>
                <span class="text">Manage Vehicles</span>
            </div>

            <div class="boxes">
                <a href="<?php echo URLROOT; ?>/owners/addVehicle">
                    <div class="box box1">
                        <i class="uil uil-plus-circle"></i>
                        <span class="text">Add Vehicle</span>
                    </div>
                </a>
            </div>
        </div>

        <div class="activity">

            <div class="activity-data">

                <div class="data names">
                    <span class="data-title">Vehicle</span>
                    <?php foreach ($data['vehicles'] as $vehicle): ?>
                        <span class="data-list">
                            <img src="<?php echo URLROOT; ?>/uploads/<?php echo $vehicle->image_vehicle; ?>" alt="vehicle photo" class="vehicle-image">
                        </span>
                    <?php endforeach; ?>
                </div>

                <div class="data email">
                    <span class="data-title">Registration Number</span>
                    <?php foreach ($data['vehicles'] as $vehicle): ?>
                        <span class="data-list">
                            <?php echo $vehicle->licensePlate; ?>
                        </span>
                    <?php endforeach; ?>
                </div>

                <div class="data joined">
                    <span class="data-title">Total Seats</span>
                    <?php foreach ($data['vehicles'] as $vehicle): ?>
                        <span class="data-list data-grade">
                            <?php echo $vehicle->totalSeats; ?>
                        </span>
                    <?php endforeach; ?>
                </div>

                <div class="data type">
                    <span class="data-title">Vacant Seats</span>
                    <?php foreach ($data['vehicles'] as $vehicle): ?>
                        <span class="data-list" style="color: rgb(18, 207, 18)">
                            <?php echo $vehicle->vacantSeats; ?>
                        </span>
                    <?php endforeach; ?>
                </div>

                <div class="data status">
                    <span class="data-title">Vehicle Driver</span>
                    <?php foreach ($data['vehicles'] as $vehicle): ?>
                        <span class="data-list">
                            <?php if (!empty($vehicle->firstName)) : ?>
                                <?php echo $vehicle->firstName; ?> <?php echo $vehicle->lastName; ?>
                            <?php else : ?>
                                <span style="font-style: italic;">Not Assigned</span>
                            <?php endif; ?>
                        </span>
                    <?php endforeach; ?>
                </div>

                <div class="data status">
                    <span class="data-title">Approval</span>
                    <?php foreach ($data['vehicles'] as $vehicle): ?>
                        <span class="data-list">
                            <?php if ($vehicle->approvedState == 0) : ?>
                                <span style="color: rgb(255, 0, 0);"><i class="uil uil-info-circle"></i>&nbsp;Pending</span>
                            <?php else : ?>
                                <span style="color: rgb(18, 207, 18);"><i class="uil uil-check-circle"></i>&nbsp;Approved</span>
                            <?php endif; ?>
                        </span>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>
    </section>

    <script src="<?php echo URLROOT; ?>/owner/script.js"></script>

    <?php require APPROOT . '/views/inc/footer.php'; ?>