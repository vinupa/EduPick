<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/owner/Owner.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<title>
    <?php echo SITENAME; ?> | Register Vehicles
</title>
</head>

<body> 
    <?php require APPROOT . '/views/inc/ownerNav.php'; ?>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <span class="text">Register Vehicle</span>
                </div>
            </div>

            <!--<div class="goback-link">
                <a href="<?php echo URLROOT; ?>/parents/manageChildren">
                    <i class="uil uil-backward"></i>
                    <span class="text">Back to Dashboard</span>
                </a>
            </div>-->

            <div class="add-child">
                <form action="<?php echo URLROOT; ?>/owners/addVehicle" method="POST">
                    <div class="input-box">
                        <span class="details">Model</span>
                        <input type="text" id="features" name="features">
                    </div>

                    <div class="input-box">
                        <span class="details">License Plate</span>
                        <input type="text" id="licensePlate" name="licensePlate">
                    </div>

                    <div class="input-box">
                        <span class="details">Total Seats</span>
                        <input type="number" id="totalSeats" name="totalSeats">
                    </div>

                    <div class="input-box">
                        <span class="details">Vacant Seats</span>
                        <input type="number" id="vacantSeats" name="vacantSeats">
                    </div>

                    <div class="input-box">
                        <span class="details">Schools</span>
                        <input type="text" id="schools" name="schools">
                    </div>

                    <div class="input-box">
                        <span class="details">Cities</span>
                        <input type="text" id="cities" name="cities">
                    </div>
                    
                    <!-- error messages -->
                    <div class="auth-err">
                        <p> <?php echo $data['features_err']; ?></p>
                        <p> <?php echo $data['licensePlate _err']; ?></p>
                        <p> <?php echo $data['totalSeats_err']; ?></p>
                        <p> <?php echo $data['vacantSeats_err']; ?></p>
                        <p> <?php echo $data['schools_err']; ?></p>
                        <p> <?php echo $data['cities_err']; ?></p>
                      </div>
                    <div class="submit-button">
                        <input type="submit" value="Register">
                    </div>
                </form>
        </div>
    </section>

    <script src="<?php echo URLROOT; ?>/owner/Owner.js"></script>

    <?php require APPROOT . '/views/inc/footer.php'; ?>



