<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/driver/style.css" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/driver/findVehiclesStyle.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<title>
    <?php echo SITENAME; ?> | Find Vehicle
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
                <li><a href="<?php echo URLROOT; ?>/drivers/findVehicles">
                        <i class="uil uil-search"></i>
                        <span class="link-name">Find Vehicles</span>
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
                    <i class="uil uil-search"></i>
                    <span class="text">Connect with a Vehicle</span>
                </div>

            </div>

            <div class="vehicle-list">

                <?php foreach ($data['vehicles'] as $vehicle) : ?>

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
                            <div class="connect-button">
                                <?php $confirmationMessage = "Are you sure you want send a connection request to vehicle owner " . $vehicle->firstName . " " . $vehicle->lastName . "? You will not be able to send additional connection requests while a request is pending."; ?>
                                <a href="<?php echo URLROOT; ?>/drivers/requestVehicle/<?php echo $vehicle->vehicleId; ?>" onclick="return confirm('<?php echo $confirmationMessage; ?>');">
                                    Connect&nbsp;
                                    <i class="uil uil-step-forward"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>

        <script src="<?php echo URLROOT; ?>/driver/script.js"></script>

        <?php require APPROOT . '/views/inc/footer.php'; ?>