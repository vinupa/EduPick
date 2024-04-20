<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/owner/Owner.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<title>
    <?php echo SITENAME; ?> | View Drivers
</title>
</head>

<body>
    
    <?php require APPROOT . '/views/inc/ownerNav.php'; ?>

    <!--<section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <h2>Hi, Stephen</h2>
            <img src="images/profile.jpg" alt=""> 
        </div>-->

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-eye"></i>
                    <span class="text">View Drivers</span>
                </div>


                <div class="boxes">
                    <a href="<?php echo URLROOT; ?>/owners/Assign-drivers">
                        <div class="box box1">
                            <i class="uil uil-plus-circle"></i>
                            <span class="text">Assign Drivers</span>
                        </div>
                    </a>
                </div>    
                
            </div>

            <div class="activity">
                
                <div class="activity-data">
                    
                    <div class="data type">
                        <span class="data-title">Driver</span>
                        <?php foreach ($data['drivers'] as $driver): ?>
                            <span class="data-list">
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($driver->image_profilePhoto); ?>" alt="Vehicle Image">
                            </span>
                        <?php endforeach; ?>
                    </div>
                </div>

                    <div class="data type">
                        <span class="data-title">Driver ID</span>
                        <?php foreach ($data['drivers'] as $driver): ?>
                            <span class="data-list">
                                <?php echo $driver->driverID; ?>
                            </span>
                        <?php endforeach; ?>
                    </div>

                    <div class="data email">
                        <span class="data-title">First Name</span>
                        <?php foreach ($data['drivers'] as $driver): ?>
                            <span class="data-list">
                                <?php echo $driver->firstName; ?>
                            </span>
                        <?php endforeach; ?>
                    </div>

                    <div class="data email">
                        <span class="data-title">Vehicle ID</span>
                        <?php foreach ($data['drivers'] as $driver): ?>
                            <span class="data-list">
                                <?php echo $driver->vehicleID; ?>
                            </span>
                        <?php endforeach; ?>
                    </div>

                    <div class="data email">
                        <span class="data-title">Contact Number</span>
                        <?php foreach ($data['drivers'] as $driver): ?>
                            <span class="data-list">
                                <?php echo $driver->contactNumber; ?>
                            </span>
                        <?php endforeach; ?>
                    </div>

                    <div class="data icons">
                        <span class="data-title">Delete</span>
                        <?php foreach ($data['drivers'] as $driver): ?>
                            <span class="data-list">
                                <div class="delete-edit-icons">
                                    <a href="#"
                                        onclick="return confirm('Are you sure you want to remove this driver?');"><i
                                            class="uil uil-trash-alt"></i></a>
                                </div>
                            </span>
                        <?php endforeach; ?>
    
                    </div>
                </div>
            </div>
        </div>
        </section>
    
        <script src="<?php echo URLROOT; ?>/owner/Owner.js"></script>
    
        <?php require APPROOT . '/views/inc/footer.php'; ?>

                    





