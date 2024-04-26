<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/parent/style.css" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/parent/reportIncidentStyles.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<title>
    <?php echo SITENAME; ?> | Incident Reports
</title>
</head>

<body>

    <?php require APPROOT . '/views/inc/parentNav.php'; ?>

    <div class="dash-content">
        <div class="overview">
            <div class="title">
                <i class="uil uil-exclamation-octagon"></i>
                <span class="text">Incident Reports</span>
            </div>

            <div class="boxes">
                <a href="<?php echo URLROOT; ?>/parents/reportIncident">
                    <div class="box box1">
                        <i class="uil uil-plus-circle"></i>
                        <span class="text">New Report</span>
                    </div>
                </a>
            </div>
        </div>

        <div class="reports-list">
            <?php foreach ($data['reports'] as $report) : ?>
                <div class="report<?php echo $report->resolvedState ? " report-resolved" : ""; ?>">
                    <div class="report-left">
                        <div class="report-title">
                            <i class="uil uil-exclamation-octagon"></i>
                            <?php echo $report->title; ?>
                        </div>

                        <div class="report-vehicle">
                            <i class="uil uil-bus-alt"></i>
                            <span class="text">
                                Vehicle:&nbsp;<b><?php echo $report->licensePlate; ?></b>
                            </span>
                        </div>

                        <div class="report-driver">
                            <i class="uil uil-user"></i>
                            <span class="text">
                                Driver:&nbsp;<b><?php echo $report->driverFirstName . " " . $report->driverLastName; ?></b>
                            </span>
                        </div>

                        <div class="report-date">
                            <i class="uil uil-calendar-alt"></i>
                            <span class="text">
                                Reported on:&nbsp;<b><?php echo date('Y-m-d', strtotime($report->timestamp)); ?></b>
                            </span>
                        </div>
                        <div class="report-description">
                            <i class="uil uil-comment-info"></i>
                            <span class="text">
                                <?php echo $report->description; ?>
                            </span>
                        </div>
                    </div>

                    <div class="report-right">
                        <div class="report-status">
                            <span class="text">
                                Status:&nbsp;
                            </span>
                            <span class="status-<?php echo $report->resolvedState ? "resolved" : "pending"; ?>">
                                <?php echo $report->resolvedState ? "<i class='uil uil-check'></i> Resolved" : "<i class='uil uil-sync'></i> Pending"; ?>
                            </span>
                        </div>
                        <div class="report-actions">
                            <a class="mark-report<?php echo $report->resolvedState ? " button-resolved" : ""; ?>" href="<?php echo URLROOT; ?>/parents/reportResolved/<?php echo $report->incidentID; ?>">
                                <i class="uil uil-check"></i>
                                &nbsp;Mark Resolved
                            </a>
                            <a class="delete-report" href="<?php echo URLROOT; ?>/parents/reportDelete/<?php echo $report->incidentID; ?>">
                                <i class="uil uil-trash-alt"></i>
                                &nbsp;Delete Report
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
        </section>

        <script src="<?php echo URLROOT; ?>/parent/script.js"></script>

        <?php require APPROOT . '/views/inc/footer.php'; ?>