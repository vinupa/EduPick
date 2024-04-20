<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/driver/style.css" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/driver/driverFormStyle.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<title>
    <?php echo SITENAME; ?> | Driver Registration
</title>
</head>

<body>

    <?php require APPROOT . '/views/inc/driverFormNav.php'; ?>

    <div class="dash-content">
        <div class="overview">
            <div class="title" style="margin: 40px 0 30px 0;">
                <i class="uil uil-edit"></i>
                <span class="text">Driver Registration</span>
            </div>

        </div>
        <?php //echo dirname(dirname(dirname(dirname(__FILE__)))); ?>

        <!-- <div class="intro-content">
            Thank you for choosing <b>EduPick</b>, the trusted School Transport Management System. Please fill in the form below to get verified as a driver on the platform. Make sure to submit accurate proof documents to ensure a smooth verification process.
        </div> -->

        <div class="driver-form">
            <div class="driver-form-flex">
                <div class="driver-form-left">
                    <form action="<?php echo URLROOT; ?>/drivers/driverForm_post" method="POST" enctype="multipart/form-data">

                        <div class="input-box">
                            <span class="details">First Name</span>
                            <input type="text" id="first_name" name="first_name" value="<?php echo $data['driver']->firstName; ?>" readonly>
                        </div>

                        <div class="input-box">
                            <span class="details">Address</span>
                            <input type="text" id="address" name="address" value="<?php echo $data['driver']->address; ?>" readonly>
                        </div>

                        <div class="input-box">
                            <span class="details">NIC Number</span>
                            <input type="text" id="nic" name="nic" required>
                        </div>

                        <div class="input-box">
                            <span class="details">Image of the Front Side of the NIC</span>
                            <input type="file" id="nicFront" name="nicFront" accept=".jpg, .jpeg, .png" required>
                        </div>

                        <div class="input-box">
                            <span class="details">Image of the Front Side of the Driver's License</span>
                            <input type="file" id="licenseFront" name="licenseFront" accept=".jpg, .jpeg, .png" required>
                        </div>

                        <div class="input-box">
                            <span class="details">Scanned Police Report Document (PDF Format)</span>
                            <input type="file" id="policeReport" name="policeReport" accept=".pdf" required>
                        </div>


                </div>
                <div class="driver-form-right">

                    <div class="input-box">
                        <span class="details">Last Name</span>
                        <input type="text" id="last_name" name="last_name" value="<?php echo $data['driver']->lastName; ?>" readonly>
                    </div>

                    <div class="input-box">
                        <span class="details">Contact Number</span>
                        <input type="text" id="contactNumber" name="contactNumber" value="<?php echo $data['driver']->contactNumber; ?>" readonly>
                    </div>

                    <div class="input-box">
                        <span class="details">Upload a formal Photograph</span>
                        <input type="file" id="profilePhoto" name="profilePhoto" accept=".jpg, .jpeg, .png" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Image of the Rear Side of the NIC</span>
                        <input type="file" id="nicBack" name="nicBack" accept=".jpg, .jpeg, .png" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Image of the Rear Side of the Driver's License</span>
                        <input type="file" id="licenseBack" name="licenseBack" accept=".jpg, .jpeg, .png" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Scanned Proof of Residence Document (PDF Format)</span>
                        <input type="file" id="proofResidence" name="proofResidence" accept=".pdf" required>
                    </div>

                </div>
            </div>
            <?php if ($data['data_err'] != '') : ?>
                <div class="error-messages">
                    <p><?php echo $data['data_err']; ?></p>
                </div>
            <?php endif; ?>
            <div class="driver-form-flex">
                <div class="submit-button">
                    <input type="submit" value="Submit Form">
                </div>
            </div>
            </form>
        </div>

    </div>
    </section>

    <script src="<?php echo URLROOT; ?>/driver/script.js"></script>

    <?php require APPROOT . '/views/inc/footer.php'; ?>