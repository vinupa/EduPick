<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/parent/style.css" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/parent/reportIncidentStyles.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<title>
    <?php echo SITENAME; ?> | New Incident Report
</title>
</head>

<body>

    <?php require APPROOT . '/views/inc/parentNav.php'; ?>

    <div class="dash-content">
        <div class="overview">
            <div class="title">
                <i class="uil uil-clipboard"></i>
                <span class="text">File a Complaint</span>
            </div>
        </div>

        <div class="goback-link">
            <a href="<?php echo URLROOT; ?>/parents/incidentReports">
                <i class="uil uil-backward"></i>
                <span class="text">Back to Incident Reports</span>
            </a>
        </div>

        <div class="incident-form">
            <form action="<?php echo URLROOT; ?>/parents/reportIncident" method="POST">
                <div class="input-box">
                    <span class="details">Choose Associated Vehicle</span>
                    <select class="" id="vehicle" name="vehicle">
                        <option value="" disabled hidden selected>Select Vehicle</option>

                        <?php foreach ($data['vehicles'] as $vehicle) : ?>
                            <option value="<?php echo $vehicle->vehicleId; ?>">
                                <?php echo "Vehicle of child " . $vehicle->childFirstName . " " . $vehicle->childLastName . " : " . $vehicle->licensePlate . " driven by " . $vehicle->driverFirstName . " " . $vehicle->driverLastName ?>
                            </option>
                        <?php endforeach; ?>

                    </select>
                </div>
                <div class="input-box">
                    <span class="details">Title</span>
                    <input type="text" id="title" name="title" placeholder="Title of the complaint" value="<?php echo $data['title']; ?>" required>
                </div>
                <div class="input-box">
                    <span class="details">Description</span>
                    <textarea id="description" name="description" placeholder="Enter a brief description of the problem" rows="6" required><?php echo $data['description']; ?></textarea>
                </div>
                <div class="auth-err">
                    <p> <?php echo $data['vehicle_err']; ?></p>
                </div>
                <div class="submit-button">
                    <input type="submit" value="Submit Report">
                </div>
            </form>
        </div>

    </div>
    </section>

    <script src="<?php echo URLROOT; ?>/parent/script.js"></script>

    <?php require APPROOT . '/views/inc/footer.php'; ?>