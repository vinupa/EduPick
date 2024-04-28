<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/owner/style.css" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/owner/childRequestsStyles.css" />
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
                <span class="text">Pending Parent Requests</span>
            </div>
        </div>

        <div class="activity">

            <div class="request-list">

                <?php foreach ($data['requests'] as $request) : ?>

                    <div class="request-card">

                        <div class="request-details">
                            <span class="request-text" style="font-size: large;">
                                Parent Name:
                                <b>
                                    <?php echo $request->parentFirstName; ?>&nbsp;<?php echo $request->parentLastName; ?>
                                </b>
                            </span>
                            <span class="request-text">
                                <i class="uil uil-phone"></i>
                                <b>Tel:&nbsp;</b>
                                <?php echo $request->contactNumber; ?>
                            </span>
                        </div>
                        <div class="request-details">
                            <span class="request-text">
                                Child Name:
                                <b>
                                    <?php echo $request->firstName; ?>&nbsp;<?php echo $request->lastName; ?>
                                </b>
                            </span>
                            <span class="request-text">
                                Grade <?php echo $request->grade; ?>, <?php echo $request->schoolName; ?>
                            </span>
                        </div>
                        <div class="request-details">
                            <span class="request-text">
                                Vehicle: <?php echo $request->model; ?>
                            </span>
                            <span class="request-text">
                                <?php echo $request->licensePlate; ?>
                            </span>
                        </div>
                        <div class="request-buttons">
                            <div class="accept-button">
                                <?php $confirmationMessage = "Are you sure you want to Accept the connection request of Parent " . $request->parentFirstName . " " . $request->parentLastName . " for your vehicle " . $request->licensePlate . "?"; ?>
                                <a href="<?php echo URLROOT; ?>/owners/acceptChildRequest/<?php echo $request->requestId; ?>" onclick="return confirm('<?php echo $confirmationMessage; ?>');">
                                    Accept&nbsp;
                                    <i class="uil uil-check"></i>
                                </a>
                            </div>
                        </div>
                        <div class="request-buttons">
                            <div class="decline-button">
                                <?php $confirmationMessage = "Are you sure you want to Decline the connection request of Parent " . $request->parentFirstName . " " . $request->parentLastName . " for your vehicle " . $request->licensePlate . "?"; ?>
                                <a href="<?php echo URLROOT; ?>/owners/declineChildRequest/<?php echo $request->requestId; ?>" onclick="return confirm('<?php echo $confirmationMessage; ?>');">
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