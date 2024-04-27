<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/owner/style.css" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/owner/driverRequestsStyles.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<title>
    <?php echo SITENAME; ?> | Manage requests
</title>
</head>

<body>

    <?php require APPROOT . '/views/inc/ownerNav.php'; ?>

    <div class="dash-content">
        <div class="overview">
            <div class="title">
                <i class="uil uil-streering"></i>
                <span class="text">Pending Child Requests</span>
            </div>
        </div>

        <div class="activity">

            <div class="request-list">

                <?php foreach ($data['childrequests'] as $childrequest) : ?>

                    <div class="request-card">

                        <div class="request-details">
                            <span class="request-text"  style="font-size: large;">
                                Parent: <?php echo $childrequest->firstName;  ?>
                            </span>
                            <span class="request-text">
                                <i class="uil uil-phone"></i>
                                <b>Tel:&nbsp;</b>
                                <?php echo $childrequest->contactNumber; ?>
                            </span>   
                        </div>

                        <div class="request-details">
                        <span class="request-text" style="font-size: large;">
                                <b>
                                 Child: <?php echo $childrequest->childFirstName;  ?>
                                </b>
                            </span>
                            <span class="request-text">
                             <i class="uil uil-estate"></i>
                                <b>School:&nbsp;</b>
                                <?php echo $childrequest->school; ?>
                            </span>   
                        </div>

                        <div class="request-details">
                        <span class="request-text">
                                <b>
                                 Driver: <?php echo $childrequest->driverFirstName; ?>
                                </b>
                            </span>
                            <span class="request-text">
                             <i class="uil uil-bus-school"></i>
                                <b>Registration No:&nbsp;</b>
                                <?php echo $childrequest->licensePlate; ?>
                            </span>
                            
                        </div>


                        <div class="request-buttons">
                            <div class="accept-button">
                                <?php $confirmationMessage = "Are you sure you want to Accept the connection request of " . $childrequest->childFirstName . "for your vehicle " . $childrequest->licensePlate . "?"; ?>
                                <a href="<?php echo URLROOT; ?>/owners/acceptChildRequest/<?php echo $childrequest->parentID; ?>" onclick="return confirm('<?php echo $confirmationMessage; ?>');">
                                    Accept&nbsp;
                                    <i class="uil uil-check"></i>
                                </a>
                            </div>
                            <div class="decline-button">
                                <?php $confirmationMessage = "Are you sure you want to Decline the connection request of " . $childrequest->childFirstName . " for your vehicle " . $childrequest->licensePlate . "?"; ?>
                                <a href="<?php echo URLROOT; ?>/owners/declineChildRequest/<?php echo $childrequest->parentID; ?>" onclick="return confirm('<?php echo $confirmationMessage; ?>');">
                                    Decline&nbsp;
                                    <i class="uil uil-times"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
    </section>

    <script src="<?php echo URLROOT; ?>/owner/script.js"></script>

    <?php require APPROOT . '/views/inc/footer.php'; ?>