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
                        <div class="request-image">
                            <img src="<?php echo URLROOT; ?>/uploads/<?php echo $childrequest->image_profilePhoto; ?>" alt="parent Image">
                        </div>
                        <div class="request-details">
                            <span class="request-text" style="font-size: large;">
                                <b>
                                    <?php echo $childrequest->firstName; ?>&nbsp;<?php echo $childrequest->lastName; ?>
                                </b>
                            </span>
                            <span class="request-text">
                                School: <?php echo $childrequest->model; ?>
                            </span>
                        </div>
                        <div class="request-details">
                            <span class="request-text">
                             <i class="uil uil-user-square"></i>
                                <b>NIC:&nbsp;</b>
                                <?php echo $request->nic; ?>
                            </span>
                            <span class="request-text">
                                <i class="uil uil-phone"></i>
                                <b>Tel:&nbsp;</b>
                                <?php echo $request->contactNumber; ?>
                            </span>
                        </div>
                        <div class="request-buttons">
                            <div class="accept-button">
                                <?php $confirmationMessage = "Are you sure you want to Accept the connection request of " . $request->firstName . " " . $request->lastName . " for your vehicle " . $request->model . "?"; ?>
                                <a href="<?php echo URLROOT; ?>/owners/acceptRequest/<?php echo $request->requestId; ?>" onclick="return confirm('<?php echo $confirmationMessage; ?>');">
                                    Accept&nbsp;
                                    <i class="uil uil-check"></i>
                                </a>
                            </div>
                            <div class="decline-button">
                                <?php $confirmationMessage = "Are you sure you want to Decline the connection request of " . $request->firstName . " " . $request->lastName . " for your vehicle " . $request->model . "?"; ?>
                                <a href="<?php echo URLROOT; ?>/owners/declineRequest/<?php echo $request->requestId; ?>" onclick="return confirm('<?php echo $confirmationMessage; ?>');">
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