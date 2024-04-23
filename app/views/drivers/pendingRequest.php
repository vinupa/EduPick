<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/driver/style.css" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/driver/findVehiclesStyle.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<title>
    <?php echo SITENAME; ?> | Request Pending
</title>
</head>

<body>

    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="<?php echo URLROOT; ?>/auth/logo.png" alt="">
            </div>

            <span class="logo_name">EduPick</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="<?php echo URLROOT; ?>/drivers/pendingRequest">
                        <i class="uil uil-stopwatch"></i>
                        <span class="link-name">Pending Request</span>
                    </a></li>
            </ul>

            <ul class="logout-mode">
                <li><a href="<?php echo URLROOT; ?>/users/logout">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Logout</span>
                    </a></li>

                <li class="mode">
                    <a>
                        <i class="uil uil-moon"></i>
                        <span class="link-name">Dark Mode</span>
                    </a>

                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <div class="user-profile">
                <i class="uil uil-user-circle"></i>
                <h2>Hi,
                    <?php echo $_SESSION['user_fname']; ?>
                </h2>
            </div>
        </div>

        <div class="dash-content">

            <div class="overview">
                <div class="title">
                    <i class="uil uil-stopwatch"></i>
                    <span class="text">Pending Request Approval</span>
                </div>
            </div>

            <div class="pending-message">
                You connection request has been successfully sent to the vehicle owner. Please wait for the owner to approve your request.<br>You can cancel the request anytime by clicking the cancel button below.
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
                            <?php echo $vehicle->firstName; ?>&nbsp;<?php echo $vehicle->lastName; ?>
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
                <a href="<?php echo URLROOT; ?>/drivers/cancelRequest/<?php echo $vehicle->vehicleId; ?>" class="cancel-button" onclick="return confirm('Are you sure you want to cancel this connection request?')">Cancel Request</a>
            </div>
        </div>

        <script src="<?php echo URLROOT; ?>/driver/script.js"></script>

        <?php require APPROOT . '/views/inc/footer.php'; ?>