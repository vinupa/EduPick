<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/admin-dashboard/style.css" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/admin-dashboard/approvalRequestStyle.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>
<body>
    <?php require APPROOT . '/views/inc/adminNav.php'; ?>
    <div class="dash-content">
        <div class="overview">
            <div class="title">
                <i class="uil uil-envelope"></i>
                <span class="text">Requests</span>
            </div>
            
            <!-- Iterate over vehicle requests and generate cards dynamically -->
            <?php foreach($data['vehicleRequests'] as $vehicleRequest): ?>
            <div class="blog-card">
                <div class="inner-part">
                   <label for="imgTap" class="img">
                   <img class="img-3" src="../Dashboards/Images/schoolbus2.png">
                   </label>
                   <div class="content">
                      <div class="vehicle-title">
                         Vehicle Owner : <?php echo $vehicleRequest->ownerFirstName . ' ' . $vehicleRequest->ownerLastName; ?>
                      </div>
                      <div class="text">
                        <ul class="vehicle-details">
                            <li>Vehicle Number: <?php echo $vehicleRequest->licensePlate; ?></li>
                            <li>Total Seats: <?php echo $vehicleRequest->totalSeats; ?></li>
                      </div>
                      <a href="<?php echo URLROOT; ?>/admins/vehicleApprovalDetails/<?php echo $vehicleRequest->vehicleID; ?>"><button>Read more</button></a>
                   </div>
                </div>
             </div>
             <?php endforeach; ?>
             <!-- End of dynamic card generation -->
             
        </div>
    </div>
   </section>

   <script src="<?php echo URLROOT; ?>/parent/script.js"></script>
   <?php require APPROOT . '/views/inc/footer.php'; ?>