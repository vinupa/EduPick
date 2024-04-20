<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/owner/Owner.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<title>
    <?php echo SITENAME; ?> | Owner Dashboard
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
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Dashboard</span>
                </div>


                <div class="boxes">
                    <a href="<?php echo URLROOT; ?>/owners/Vehicle-registration">
                        <div class="box box1">
                            <i class="uil uil-plus-circle"></i>
                            <span class="text">Register Vehicle</span>
                        </div>
                    </a>
                </div>    
                
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
                        <span class="data-title">License Plate</span>
                        <?php foreach ($data['vehicles'] as $vehicle): ?>
                            <span class="data-list">
                                <?php echo $vehicle->licensePlate; ?>
                            </span>
                        <?php endforeach; ?>
                    </div>

                    <div class="data email">
                        <span class="data-title">Total Seats</span>
                        <?php foreach ($data['vehicles'] as $vehicle): ?>
                            <span class="data-list">
                                <?php echo $vehicle->features; ?>
                            </span>
                        <?php endforeach; ?>
                    </div>

                    <div class="data email">
                        <span class="data-title">Vacant Seats</span>
                        <?php foreach ($data['vehicles'] as $vehicle): ?>
                            <span class="data-list">
                                <?php echo $vehicle->vacantSeats; ?>
                            </span>
                        <?php endforeach; ?>
                    </div>
                    <div class="data email">
                        <span class="data-title">Schools</span>
                        <?php foreach ($data['vehicles'] as $vehicle): ?>
                            <span class="data-list">
                                <?php echo $vehicle->schools; ?>
                            </span>
                        <?php endforeach; ?>
                    </div>

                    <div class="data email">
                        <span class="data-title">Cities</span>
                        <?php foreach ($data['vehicles'] as $vehicle): ?>
                            <span class="data-list">
                                <?php echo $vehicle->cities; ?>
                            </span>
                        <?php endforeach; ?>
                    </div>

                    <div class="data icons">
                        <span class="data-title">Delete/Edit</span>
                        <?php foreach ($data['vehicles'] as $vehicle): ?>
                            <span class="data-list">
                                <div class="delete-edit-icons">
                                    <a href="#"
                                        onclick="return confirm('Are you sure you want to remove this child?');"><i
                                            class="uil uil-trash-alt"></i></a>
                                    <a href="<?php echo URLROOT; ?>/owners/Vehicle-update/<?php echo $vehicle->vehicleID; ?>"><i
                                            class="uil uil-edit"></i></a>
                                </div>
                            </span>
                        <?php endforeach; ?>
    
                    </div>
            </div>
        </div>
        </section>
    
        <script src="<?php echo URLROOT; ?>/owner/Owner.js"></script>
    
        <?php require APPROOT . '/views/inc/footer.php'; ?>

                    