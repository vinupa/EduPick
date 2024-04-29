<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/admin-dashboard/style.css" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/admin-dashboard/approvalDetailsStyle.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
<script src="<?php echo URLROOT; ?>/admin-dashboard/script.js"></script>
<title>
    <?php echo SITENAME; ?> | Driver Approval Details
</title> 

</head>
<body>
    <?php require APPROOT . '/views/inc/adminNav.php'; ?>
    <div class="dash-content">
        <div class="overview">
            <div class="approve-details-container">
                <div class="approve-details-box">
                    <div class="images">
                        <div class="img-holder">
                        <img src="<?php echo URLROOT; ?>/uploads/<?php echo $data['driverDetails']->image_profilePhoto; ?>" alt="driver photo">
                        </div>
                    </div>
                    <div class="basic-info">
                        <h1>Driver Details</h1>
                    </div>
                    <div class="description">
                        <ul class="features">
                            <li><i class="uil uil-check-square"></i>Driver Name: <?php echo $data['driverDetails']->firstName . ' ' . $data['driverDetails']->lastName; ?></li>
                            <li><i class="uil uil-check-square"></i>NIC Number: <?php echo $data['driverDetails']->nic; ?></li>
                            <li><i class="uil uil-check-square"></i>Contact Information: <?php echo $data['driverDetails']->contactNumber; ?></li>
                            <li><i class="uil uil-check-square"></i>Owner Name: <?php echo $data['driverDetails']->ownerFirstName . ' ' . $data['driverDetails']->ownerLastName; ?></li>
                            <li><i class="uil uil-check-square"></i>NIC Front: <a href="<?php echo URLROOT; ?>/uploads/<?php echo $data['driverDetails']->image_nicFront; ?>" target="_blank">View Document</a></li>
                            <li><i class="uil uil-check-square"></i>NIC Front: <a href="<?php echo URLROOT; ?>/uploads/<?php echo $data['driverDetails']->image_nicBack; ?>" target="_blank">View Document</a></li>
                            <li><i class="uil uil-check-square"></i>License Front: <a href="<?php echo URLROOT; ?>/uploads/<?php echo $data['driverDetails']->image_licenseFront; ?>" target="_blank">View Document</a></li>
                            <li><i class="uil uil-check-square"></i>License Back: <a href="<?php echo URLROOT; ?>/uploads/<?php echo $data['driverDetails']->image_licenseBack; ?>" target="_blank">View Document</a></li>
                            <li><i class="uil uil-check-square"></i>Police Report: <a href="<?php echo URLROOT; ?>/uploads/<?php echo $data['driverDetails']->doc_policeReport; ?>" target="_blank">View Document</a></li>
                            <li><i class="uil uil-check-square"></i>Residence Proof: <a href="<?php echo URLROOT; ?>/uploads/<?php echo $data['driverDetails']->doc_proofResidence; ?>" target="_blank">View Document</a></li>
                        </ul>
                        <div class="options">
                            <a href="<?php echo URLROOT; ?>/admins/approveDriver/<?php echo $data['driverDetails']->driverID; ?>" onclick="return confirmApproval();">Approve</a>
                            <a href="<?php echo URLROOT; ?>/admins/rejectDriver/<?php echo $data['driverDetails']->driverID; ?>" onclick="return confirmRejection();">Reject</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <script src="<?php echo URLROOT; ?>/parent/script.js"></script>
    <?php require APPROOT . '/views/inc/footer.php'; ?>