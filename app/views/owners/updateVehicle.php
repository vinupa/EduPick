<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/owner/style.css" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/owner/addVehicleStyles.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<title>
    <?php echo SITENAME; ?> | Update Vehicle
</title>
</head>

<body>
    <?php require APPROOT . '/views/inc/ownerNav.php'; ?>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-edit"></i>
                    <span class="text">Update Vehicle Details</span>
                </div>
            </div>

            <div class="goback-link">
                <a href="<?php echo URLROOT; ?>/owners/manageVehicles">
                    <i class="uil uil-backward"></i>
                    <span class="text">Back to Dashboard</span>
                </a>
            </div>

            <div class="vehicle-form">
            <div class="vehicle-form-flex">
                <div class="vehicle-form-left">
                    <form action="<?php echo URLROOT; ?>/owners/updateVehicle/<?php echo $data['id'] ?>" method="POST" enctype="multipart/form-data">

                        <div class="input-box">
                            <span class="details">Registration Number (License Plate)</span>
                            <div class="license-input">
                                <input type="text" id="licensePlate1" name="licensePlate1" maxlength="3" required value="<?php echo $data['vehicle']->licensePlate ?>">
                                <span class="license-separator">-</span>
                                <input type="text" id="licensePlate2" name="licensePlate2" maxlength="4" required value="<?php echo $data['vehicle']->licensePlate ?>">
                            </div>
                        </div>

                        <div class="input-box">
                            <span class="details">Vehicle Model</span>
                            <input type="text" id="model" name="model" required value="<?php echo $data['vehicle']->model ?>">
                        </div>

                        <div class="input-box">
                            <div class="seats-inputs">
                                <div class="seats-input">
                                    <span class="details">Total Seats</span>
                                    <input type="number" id="totalSeats" name="totalSeats" required value = "<?php echo $data['vehicle']->totalSeats ?>" >
                                </div>
                                <div class="seats-input">
                                    <span class="details">Vacant Seats</span>
                                    <input type="number" id="vacantSeats" name="vacantSeats" required value="<?php echo $data['vehicle']->vacantSeats ?>">
                                </div>
                            </div>
                        </div>

                        <div class="input-box">
                            <span class="details">Citites Covered in the Vehicle Route</span>
                            <?php foreach ($data['coveredCities'] as $city) : ?>
                                <div class="city">
                                    <input type="checkbox" id="<?php echo $city->cityId; ?>" name="city[]" value="<?php echo $city->cityId; ?>" class="city-input">
                                    <label for="<?php echo $city->cityId; ?>"><?php echo $city->name; ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                </div>

                <div class="vehicle-form-right">

                    <div class="input-box">
                        <span class="details">Features:</span>
                        <div class="features">
                            <div class="feature">
                                <input type="checkbox" id="ac" name="ac" value="ac" class="feature-input" value="<?php echo $data['vehicle']->ac ?>">
                                <label for="ac">A/C</label>
                            </div>
                            <div class="feature">
                                <input type="checkbox" id="highroof" name="highroof" value="highroof" class="feature-input">
                                <label for="highroof">High Roof</label>
                            </div>
                        </div>
                    </div>

                    <div class="input-box">
                        <span class="details">Year of Manufacture</span>
                        <input type="number" id="modelYear" name="modelYear" maxlength="4" required value="<?php echo $data['vehicle']->modelYear ?>">>
                    </div>

                    <div class="input-box">
                            <span class="details">Schools Covered in the Vehicle Route</span>
                            <?php foreach ($data['coveredSchools'] as $school) : ?>
                                <div class="school">
                                <input type="checkbox" id="school<?php echo $school->schoolId; ?>" <?php echo ($school->schoolId == $data['id']) ? 'checked' : '' ; ?> name="schools[]" value="<?php echo $school->schoolId; ?>" >
                                <label for="school_<?php echo $school->schoolId; ?>"><?php echo $school->name; ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        
    

                </div>
            </div>

            <?php if ($data['data_err'] != '') : ?>
                <div class="error-messages">
                    <p><?php echo $data['data_err']; ?></p>
                </div>
            <?php endif; ?>

            <div class="vehicle-form-flex">
                <div class="submit-button">
                    <input type="submit" value="Submit Form">
                </div>
            </div>
            </form>
        </div>
        </section>

        <script>
            const featureInputs = document.querySelectorAll('.feature-input');

            featureInputs.forEach((featureInput) => {
                featureInput.addEventListener('change', () => {
                    const feature = featureInput.parentElement;
                    if (featureInput.checked) {
                        feature.style.backgroundColor = 'var(--delete-edit-color)';
                        feature.style.color = 'var(--title-icon-color)';
                    } else {
                        feature.style.backgroundColor = '';
                        feature.style.color = '';
                    }
                });
            });
        </script>

        <script src="<?php echo URLROOT; ?>/parent/script.js"></script>

        <?php require APPROOT . '/views/inc/footer.php'; ?>