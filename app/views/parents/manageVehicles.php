<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/parent/style.css" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/parent/manageVehiclesStyles.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<title>
    <?php echo SITENAME; ?> | Manage Vehicles
</title>
</head>

<body>

    <?php require APPROOT . '/views/inc/parentNav.php'; ?>

    <div class="dash-content">

        <div class="overview">
            <div class="title">
                <i class="uil uil-search"></i>
                <span class="text">Manage Connected Vehicles</span>
            </div>
        </div>
        <?php if (!empty($data['children'])) : ?>
        <div class="child-list">

            <?php foreach ($data['children'] as $child) : ?>
                <div class="child-card">
                    <div class="child-details">
                        <span class="child-text" style="font-size: large;">
                            <b><?php echo $child->firstName . ' ' . $child->lastName; ?></b>
                        </span>
                        <span class="child-text">
                            <?php echo $child->schoolName ?>
                        </span>
                    </div>
                    <div class="attendance-buttons">
                        <div class="attend-button<?php echo $child->absentState ? '' : '-selected'; ?>">
                            <a href="<?php echo URLROOT; ?>/parents/childAttending/<?php echo $child->childID; ?>">
                                Attending
                            </a>
                        </div>
                        <div class="absent-button<?php echo $child->absentState ? '-selected' : ''; ?>">
                            <a href="<?php echo URLROOT; ?>/parents/childAbsent/<?php echo $child->childID; ?>">
                                Absent
                            </a>
                        </div>
                    </div>

                    <div class="child-details">
                        <div class="leave-button">
                            <?php $confirmationMessage = "Are you sure that you want to disconnect your child " . $child->firstName . " " . $child->lastName . " from the vehicle?"; ?>
                            <a href="<?php echo URLROOT; ?>/parents/disconnectVehicle/<?php echo $child->childID; ?>" onclick="return confirm('<?php echo $confirmationMessage; ?>');">
                                Disconnect&nbsp;
                                <i class="uil uil-sign-out-alt"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <?php else : ?>
                <div class="no-children">
                    <span class="text">No children connected to any vehicles</span>
                </div>
            <?php endif; ?>

        </div>
    </div>


    <script src="<?php echo URLROOT; ?>/parent/script.js"></script>

    <?php require APPROOT . '/views/inc/footer.php'; ?>