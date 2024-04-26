<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/driver/style.css" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/driver/vehicleDetailsStyles.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<title>
    <?php echo SITENAME; ?> | Vehicle Details
</title>
</head>

<body>

    <?php require APPROOT . '/views/inc/driverNav.php'; ?>

    <div class="dash-content">

            <div class="overview">
                <div class="title">
                    <i class="uil uil-bus-school"></i>
                    <span class="text">Vehicle Details</span>
                </div>
            </div>

            <?php $vehicle =  $data['vehicle']; ?>
            <div class="vehicle-card-pending">
                <div class="vehicle-card">
                    <div class="vehicle-image">
                        <img src="<?php echo URLROOT; ?>/uploads/<?php echo $vehicle->image_vehicle; ?>" alt="Vehicle Image">
                    </div>
                    <div class="vehicle-details">
                        <span class="vehicle-text" style="font-size: 24px;">
                            <b>
                                <?php echo $vehicle->model; ?>
                            </b>
                        </span>
                        <span class="vehicle-text">
                            Model Year: <?php echo $vehicle->modelYear; ?><br><br>
                        </span>
                        <span class="vehicle-text">
                            <i class="uil uil-users-alt"></i>
                            <b>Total Seats:&nbsp;</b>
                            <?php echo $vehicle->totalSeats; ?>
                        </span>
                        <span class="vehicle-text">
                            <i class="uil uil-users-alt"></i>
                            <b>Vacant Seats:&nbsp;</b>
                            <span style="color: green"><?php echo $vehicle->vacantSeats; ?></span>
                        </span>
                        <span class="vehicle-text">
                            <i class="uil uil-wind"></i>
                            <b>A/C:&nbsp;</b>
                            <?php echo $vehicle->ac == 1 ? 'Yes' : 'No'; ?>
                        </span>
                        <span class="vehicle-text">
                            <i class="uil uil-bus-school"></i>
                            <b>HighRoof:&nbsp;</b>
                            <?php echo $vehicle->highroof == 1 ? 'Yes' : 'No'; ?>
                        </span>
                        
                    </div>
                    
                    
                    <div class="vehicle-details">
                        <span class="vehicle-text" style="margin-top: 32px;">
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
                        <span class="connected-text"><i class="uil uil-link-alt"></i>&nbsp;Connected</span>
                    </div>
                </div>
            </div>
            <div class="cancel-pending">
                <?php $confirmationMessage = "Are you sure you want to resign from the vehicle " . $vehicle->licensePlate . " owned by " . $vehicle->firstName . " " . $vehicle->lastName . "? You will have to send a request to them again if you wish to rejoin."; ?>
                <a href="<?php echo URLROOT; ?>/drivers/resignVehicle/<?php echo $_SESSION['user_id']; ?>" class="cancel-button" onclick="return confirm('<?php echo $confirmationMessage ?>')">Resign</a>
            </div>
        </div>

        <script src="<?php echo URLROOT; ?>/driver/script.js"></script>

        <?php require APPROOT . '/views/inc/footer.php'; ?>