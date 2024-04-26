<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/parent/style.css" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/parent/pendingRequestStyles.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<title>
    <?php echo SITENAME; ?> | Request Pending
</title>
</head>

<body>

    <?php require APPROOT . '/views/inc/parentNav.php'; ?>

    <div class="dash-content">

        <div class="overview">
            <div class="title">
                <i class="uil uil-search"></i>
                <span class="text">Pending Connection Request</span>
            </div>
            <div class="selected-child">
                <div class="child-details">
                    <i class="uil uil-user-square"></i>
                    <div class="child-name"><?php echo $_SESSION['childName']; ?></div>
                </div>
                <div class="change-child">
                    <a href="<?php echo URLROOT; ?>/parents/selectChild">
                        <i class="uil uil-exchange"></i>
                        Select Child
                    </a>
                </div>
            </div>
        </div>

        <div class="request-message-line">
            <span class="text">
                Your connection request for your child&nbsp;
            </span>
            <div class="request-message-name">
                <span class="name">
                    <?php echo $_SESSION['childName']; ?>
                </span>
            </div>
            <span class="text">
                &nbsp;has been succesfully sent to the vehicle owner.
            </span>
        </div>
        <div class="request-message-line">
            <span class="text">
                Please wait for the owner to approve your request.
            </span>
        </div>
        <div class="request-message-line">
            <span class="text">
                &nbsp;
            </span>
        </div>
        <div class="request-message-line">
            <span class="text">
                Contact the owner&nbsp;
            </span>
            <div class="request-message-name">
                <span class="name">
                    <?php echo $data['vehicle']->firstName; ?>&nbsp;<?php echo $data['vehicle']->lastName; ?>
                </span>
            </div>
            <span class="text">
                &nbsp;on&nbsp;
            </span>
            <div class="request-message-name">
                <span class="name">
                    <?php echo $data['vehicle']->contactNumber; ?>
                </span>
            </div>
            <span class="text">
                &nbsp;for any clarifications and confirmation.&nbsp;
            </span>
        </div>

        <div class="subtopic">
            <i class="uil uil-user-md"></i>
            <span class="text">Driver Details</span>
        </div>

        <?php $driver =  $data['driver']; ?>
        <div class="vehicle-card-pending">
            <div class="vehicle-card">
                <div class="vehicle-image">
                    <img src="<?php echo URLROOT; ?>/uploads/<?php echo $driver->image_profilePhoto; ?>" alt="Vehicle Image">
                </div>
                <div class="vehicle-details">
                    <span class="vehicle-text" style="font-size: large;">
                        <b>
                            <?php echo $driver->firstName; ?>&nbsp;<?php echo $driver->lastName; ?>
                        </b>
                    </span>
                    <span class="vehicle-text">
                        <i class="uil uil-user-square"></i>
                        NIC: <?php echo $driver->nic; ?>
                    </span>
                </div>
                <div class="vehicle-details">
                    <span class="vehicle-text">
                        <i class="uil uil-phone"></i>
                        <b>Tel:&nbsp;</b>
                        <?php echo $driver->contactNumber; ?>
                    </span>
                    <span class="vehicle-text">
                        <i class="uil uil-location-pin-alt"></i>
                        <b>Address:&nbsp;</b>
                        <?php echo $driver->address; ?>
                    </span>
                </div>
                <div class="vehicle-details">
                    <span class="verified-text"><i class="uil uil-user-check"></i>&nbsp;Verified Driver</span>
                </div>
            </div>
        </div>

        <div class="subtopic">
            <i class="uil uil-bus-school"></i>
            <span class="text">Vehicle Details</span>
        </div>

        <?php $vehicle =  $data['vehicle']; ?>
        <div class="vehicle-card-pending">
            <div class="vehicle-card">
                <div class="vehicle-image">
                    <img src="<?php echo URLROOT; ?>/uploads/<?php echo $vehicle->image_vehicle; ?>" alt="Vehicle Image">
                </div>
                <div class="vehicle-details">
                    <span class="vehicle-text" style="font-size: large;">
                        <b>
                            <?php echo $vehicle->model; ?>
                        </b>
                    </span>
                    <span class="vehicle-text">
                        Model Year: <?php echo $vehicle->modelYear; ?>
                    </span>
                </div>
                <div class="vehicle-details">
                    <span class="vehicle-text">
                        <i class="uil uil-users-alt"></i>
                        <b>Seats:&nbsp;</b>
                        <?php echo $vehicle->totalSeats; ?>
                    </span>
                    <span class="vehicle-text">
                        <i class="uil uil-wind"></i>
                        <b>A/C:&nbsp;</b>
                        <?php echo $vehicle->ac == 1 ? 'Yes' : 'No'; ?>
                    </span>
                </div>
                <div class="vehicle-details">
                    <span class="vehicle-text">
                        <b>Owner:&nbsp;</b>
                        <?php echo $vehicle->firstName; ?>&nbsp;<?php //echo $vehicle->lastName; 
                                                                ?>
                    </span>
                    <span class="vehicle-text">
                        <i class="uil uil-phone"></i>
                        <b>Tel:&nbsp;</b>
                        <?php echo $vehicle->contactNumber; ?>
                    </span>
                </div>
                <div class="vehicle-details">
                    <span class="pending-text"><i class="uil uil-info-circle"></i>&nbsp;Pending</span>
                </div>
            </div>
        </div>

        <div class="cancel-pending">
            <a href="<?php echo URLROOT; ?>/parents/cancelRequest/<?php echo $_SESSION['childID']; ?>" class="cancel-button" onclick="return confirm('Are you sure you want to cancel this connection request?')">Cancel Request</a>
        </div>

    </div>

    <script src="<?php echo URLROOT; ?>/parent/script.js"></script>

    <?php require APPROOT . '/views/inc/footer.php'; ?>