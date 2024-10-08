<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/parent/style.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<title>
    <?php echo SITENAME; ?> | Manage Children
</title>
</head>

<body>

    <?php require APPROOT . '/views/inc/parentNav.php'; ?>

    <div class="dash-content">
        <div class="overview">
            <div class="title">
                <i class="uil uil-users-alt"></i>
                <span class="text">Manage Children</span>
            </div>

            <div class="boxes">
                <a href="<?php echo URLROOT; ?>/parents/addChild">
                    <div class="box box1">
                        <i class="uil uil-plus-circle"></i>
                        <span class="text">Add Child</span>
                    </div>
                </a>
            </div>
        </div>

        <div class="activity">

            <div class="activity-data">

                <div class="data names">
                    <span class="data-title">Child Name</span>
                    <?php foreach ($data['children'] as $child): ?>
                        <span class="data-list">
                            <?php echo $child->firstName; ?>
                            <?php echo $child->lastName; ?>
                        </span>
                    <?php endforeach; ?>
                </div>

                <div class="data email">
                    <span class="data-title">School</span>
                    <?php foreach ($data['children'] as $child): ?>
                        <span class="data-list">
                            <?php echo $child->schoolName; ?>
                        </span>
                    <?php endforeach; ?>
                </div>

                <div class="data joined">
                    <span class="data-title">Grade</span>
                    <?php foreach ($data['children'] as $child): ?>
                        <span class="data-list data-grade">
                            <?php echo $child->grade; ?>
                        </span>
                    <?php endforeach; ?>
                </div>

                <div class="data type">
                    <span class="data-title">Vehicle</span>
                    <?php foreach ($data['children'] as $child): ?>
                        <span class="data-list">
                            <?php echo $child->licensePlate ? $child->licensePlate : '<i>N/A</i>'; ?>
                        </span>
                    <?php endforeach; ?>
                </div>

                <div class="data status">
                    <span class="data-title">Vehicle Driver</span>
                    <?php foreach ($data['children'] as $child): ?>
                        <span class="data-list">
                            <?php echo $child->driverFirstName ? $child->driverFirstName . ' ' . $child->driverLastName : '<i>N/A</i>'; ?>
                        </span>
                    <?php endforeach; ?>
                </div>

                <div class="data icons">
                    <span class="data-title">Delete/Edit</span>
                    <?php foreach ($data['children'] as $child): ?>
                        <span class="data-list">
                            <div class="delete-edit-icons">
                                <!-- show the two links only if licensePlate is null -->
                                <?php if (!$child->licensePlate): ?>
                                    <a href="<?php echo URLROOT; ?>/parents/removeChild/<?php echo $child->childID; ?>"
                                        onclick="return confirm('Are you sure you want to remove this child?');"><i
                                            class="uil uil-trash-alt"></i></a>
                                    <a href="<?php echo URLROOT; ?>/parents/updateChild/<?php echo $child->childID; ?>"><i
                                            class="uil uil-edit"></i></a>
                                <?php else: ?>
                                    <span class="linked-text">
                                        <i class="uil uil-info-circle"></i>&nbsp;Linked
                                    </span>
                                <?php endif; ?>
                            </div>
                        </span>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
    </section>

    <script src="<?php echo URLROOT; ?>/parent/script.js"></script>

    <?php require APPROOT . '/views/inc/footer.php'; ?>