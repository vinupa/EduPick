<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/admin-dashboard/style.css" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/admin-dashboard/approvalDetailsStyle.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
<script src="<?php echo URLROOT; ?>/admin-dashboard/script.js"></script>
<title>
    <?php echo SITENAME; ?> | Vehicle Approval Details
</title> 

</head>
<body>
    <?php require APPROOT . '/views/inc/adminNav.php'; ?>
    <div class="dash-content">
        <div class="overview">
            <di v class="approve-details-container">
                <div class="approve-details-box">
                    <div class="images">
                        <!-- If you have multiple images, loop through them here -->
                        <div class="img-holder">
                        <img src="<?php echo URLROOT; ?>/uploads/<?php echo $data['vehicleDetails']->image_vehicle; ?>" alt="vehicle photo">
                        </div>
                    </div>
                    <div class="basic-info">
                        <h1>High Roof Van</h1>
                    </div>
                    <div class="description">
                        <ul class="features">
                            <li><i class="uil uil-check-square"></i>Owner Name: <?php echo $data['vehicleDetails']->ownerFirstName . ' ' . $data['vehicleDetails']->ownerLastName; ?></li>
                            <li><i class="uil uil-check-square"></i>Vehicle Number: <?php echo $data['vehicleDetails']->licensePlate; ?></li>
                            <li><i class="uil uil-check-square"></i>Total Seats: <?php echo $data['vehicleDetails']->totalSeats; ?></li>
                            <li><i class="uil uil-check-square"></i>Contact Information: <?php echo $data['vehicleDetails']->ownerContactNumber; ?></li>
                            <li><i class="uil uil-check-square"></i>Vehicle Registration Document: <a href="<?php echo URLROOT; ?>/uploads/<?php echo $data['vehicleDetails']->doc_registration; ?>" target="_blank">View Document</a></li>
                            <li><i class="uil uil-check-square"></i>Emission Report: <a href="<?php echo URLROOT; ?>/uploads/<?php echo $data['vehicleDetails']->doc_emissions; ?>" target="_blank">View Document</a></li>
                        </ul>
                        <div class="options">
                            <a href="<?php echo URLROOT; ?>/admins/approveVehicle/<?php echo $data['vehicleDetails']->vehicleId; ?>" onclick="return confirmVehicleApproval();">Approve</a>
                            <a href="<?php echo URLROOT; ?>/admins/rejectVehicle/<?php echo $data['vehicleDetails']->vehicleId; ?>" onclick="return confirmVehicleRejection();">Reject</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <script src="<?php echo URLROOT; ?>/parent/script.js"></script>
    <?php require APPROOT . '/views/inc/footer.php'; ?>