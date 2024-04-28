<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/admin-dashboard/style.css" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/admin-dashboard/approvalRequestStyle.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<title>
    <?php echo SITENAME; ?> | Driver Approval
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
            
            <!-- Iterate over driver requests and generate cards dynamically -->
            <?php foreach($data['driverRequests'] as $driverRequest): ?>
            <div class="blog-card">
                <div class="inner-part">
                   <label for="imgTap" class="img">
                   <img class="img-3" src="<?php echo URLROOT; ?>/uploads/<?php echo $driverRequest->image_profilePhoto; ?>" alt="driver photo">
                   </label>
                   <div class="content">
                      <div class="vehicle-title">
                         Driver Name: <?php echo $driverRequest->firstName . ' ' . $driverRequest->lastName; ?>
                      </div>
                      <div class="text">
                        <ul class="vehicle-details">
                            <li>NIC Number: <?php echo $driverRequest->nic; ?></li>
                            <li>Owner Name: <?php echo $driverRequest->ownerFirstName . ' ' . $driverRequest->ownerLastName; ?></li>
                      </div>
                      <a href="<?php echo URLROOT; ?>/admins/driverApprovalDetails/<?php echo $driverRequest->driverID; ?>"><button>Read more</button></a>
                   </div>
                </div>
             </div>
             <?php endforeach; ?>
             
        </div>
    </div>
   </section>

   <script src="<?php echo URLROOT; ?>/parent/script.js"></script>
   <?php require APPROOT . '/views/inc/footer.php'; ?>