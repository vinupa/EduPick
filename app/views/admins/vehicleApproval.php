<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/admin-dashboard/style.css" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/admin-dashboard/approvalRequestStyle.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<title>
    <?php echo SITENAME; ?> | Vehicle Approval
</title> 

</head>
<body>
    <?php require APPROOT . '/views/inc/adminNav.php'; ?>
    <div class="dash-content">
        <?php require APPROOT . '/views/admins/approvalAlert.php'; ?>
        <div class="overview">
            <div class="title">
                <i class="uil uil-envelope"></i>
                <span class="text">Requests</span>
            </div>
            
            <?php foreach($data['vehicleRequests'] as $vehicleRequest): ?>
            <div class="blog-card">
                <div class="inner-part">
                   <label for="imgTap" class="img">
                   <img class="img-3" src="<?php echo URLROOT; ?>/uploads/<?php echo $vehicleRequest->image_vehicle; ?>" alt="vehicle photo">
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
                      <a href="<?php echo URLROOT; ?>/admins/vehicleApprovalDetails/<?php echo $vehicleRequest->vehicleId; ?>"><button>Read more</button></a>
                   </div>
                </div>
             </div>
             <?php endforeach; ?>
        </div>
    </div>
   </section>

   <script src="<?php echo URLROOT; ?>/parent/script.js"></script>
   <?php require APPROOT . '/views/inc/footer.php'; ?>