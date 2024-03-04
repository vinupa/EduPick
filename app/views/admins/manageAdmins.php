<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/admin-dashboard/style.css" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/admin-dashboard/approvalRequestStyle.css" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/parent/style.css" />    
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<title>
    <?php echo SITENAME; ?> | Manage Children
</title>
</head>

<body>

    <?php require APPROOT . '/views/inc/adminNav.php'; ?>

    <div class="dash-content">
        <?php require APPROOT . '/views/admins/approvalAlert.php'; ?>
        <div class="overview">
            <div class="title">
                <i class="uil uil-tachometer-fast-alt"></i>
                <span class="text">Dashboard</span>
            </div>

            <div class="boxes">
                <a href="<?php echo URLROOT; ?>/users/adminRegister">
                    <div class="box box1">
                        <i class="uil uil-plus-circle"></i>
                        <span class="text">Add Admin</span>
                    </div>
                </a>
            </div>
        </div>

        <div class="activity">

            <div class="activity-data">

                <div class="data names">
                    <span class="data-title">Admin Name</span>
                    <?php foreach ($data['admins'] as $admin): ?>
                        <span class="data-list">
                            <?php echo $admin->firstName; ?>
                            <?php echo $admin->lastName; ?>
                        </span>
                    <?php endforeach; ?>
                </div>

                <div class="data email">
                    <span class="data-title">Email</span>
                    <?php foreach ($data['admins'] as $admin): ?>
                        <span class="data-list">
                            <?php echo $admin->email; ?>
                        </span>
                    <?php endforeach; ?>
                </div>

                <div class="data joined">
                    <span class="data-title">Contact Number</span>
                    <?php foreach ($data['admins'] as $admin): ?>
                        <span class="data-list data-grade">
                            <?php echo $admin->contactNumber; ?>
                        </span>
                    <?php endforeach; ?>
                </div>

                <div class="data type">
                    <span class="data-title">Registration Date</span>
                    <?php foreach ($data['admins'] as $admin): ?>
                        <span class="data-list">
                            <?php echo $admin->regDate; ?>
                        </span>
                    <?php endforeach; ?>
                </div>

                <div class="data icons">
                    <span class="data-title">Delete/Edit</span>
                    <?php foreach ($data['admins'] as $admin): ?>
                        <span class="data-list">
                            <div class="delete-edit-icons">
                                <a href="<?php echo URLROOT; ?>/parents/removeChild/<?php echo $admin->adminID; ?>"
                                    onclick="return confirm('Are you sure you want to remove this admin?');"><i
                                        class="uil uil-trash-alt"></i></a>
                                <a href="<?php echo URLROOT; ?>/admins/updateAdmin/<?php echo $admin->adminID; ?>"><i
                                        class="uil uil-edit"></i></a>
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