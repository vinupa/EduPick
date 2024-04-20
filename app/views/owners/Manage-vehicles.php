<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/owner/Owner.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<title>
    <?php echo SITENAME; ?> | Manage Vehicles
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
                    <i class="uil uil-chart"></i>
                    <span class="text">Manage Vehicles</span>
                </div>
            

            <div class="activity">
                
                <div class="activity-data">
                    
                    <div class="data type">
                        <span class="data-title">Vehicle ID</span>
                        <?php foreach ($data['vehicles'] as $vehicle): ?>
                            <span class="data-list">
                                <?php echo $vehicle->vehicleID; ?>
                            </span>
                        <?php endforeach; ?>
                    </div>

                    <div class="data email">
                        <span class="data-title">Model</span>
                        <?php foreach ($data['vehicles'] as $vehicle): ?>
                            <span class="data-list">
                                <?php echo $vehicle->features; ?>
                            </span>
                        <?php endforeach; ?>
                    </div>

                    <div class="data icons">
                        <span class="data-title">Assign Drivers</span>
                        <?php foreach ($data['vehicles'] as $vehicle): ?>
                            <span class="data-list">
                                <div class="delete-edit-icons">
                                    <a href="<?php echo URLROOT; ?>/owners/Assign-drivers/<?php echo $driver->vehicleID; ?>"><i
                                            class="uil uil-edit"></i></a>
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

                    






