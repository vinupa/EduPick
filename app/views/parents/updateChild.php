<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/parent/style.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<title>
    <?php echo SITENAME; ?> | Update Child
</title>
</head>

<body>
    <?php require APPROOT . '/views/inc/parentNav.php'; ?>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-edit"></i>
                    <span class="text">Update Child Details</span>
                </div>
            </div>

            <div class="goback-link">
                <a href="<?php echo URLROOT; ?>/parents/manageChildren">
                    <i class="uil uil-backward"></i>
                    <span class="text">Back to Dashboard</span>
                </a>
            </div>

            <div class="add-child">
                <form action="<?php echo URLROOT; ?>/parents/updateChildPost" method="POST">
                    <div class="input-box">
                        <span class="details">First Name</span>
                        <input type="text" id="first_name" name="first_name" value="<?php echo $data['firstName'] ?>">
                    </div>
                    <div class="input-box">
                        <span class="details">Last Name</span>
                        <input type="text" id="last_name" name="last_name" value="<?php echo $data['lastName'] ?>">
                    </div>
                    <div class="input-box">
                        <span class="details">School</span>
                        <select class="" id="school" name="school">
                            <option value="" disabled hidden selected>Select School</option>

                            <?php foreach($data['schools'] as $school): ?>
                                <option value="<?php echo $school->schoolId; ?>" <?php echo ($data['school'] == $school->schoolId) ? 'selected' : ''?>><?php echo $school->name; ?></option>
                            <?php endforeach; ?>
                            
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">Grade</span>
                        <input type="number" id="grade" name="grade" value="<?php echo $data['grade'] ?>">
                    </div>

                    <input type="hidden" name="child_id" value="<?php echo $data['child_id'] ?>">
                    
                    <!-- error messages -->
                    <div class="auth-err">
                        <p> <?php echo $data['firstName_err']; ?></p>
                        <p> <?php echo $data['lastName_err']; ?></p>
                        <p> <?php echo $data['school_err']; ?></p>
                        <p> <?php echo $data['grade_err']; ?></p>
                      </div>
                    <div class="submit-button">
                        <input type="submit" value="Update">
                    </div>
                </form>
        </div>
    </section>

    <script src="<?php echo URLROOT; ?>/parent/script.js"></script>

    <?php require APPROOT . '/views/inc/footer.php'; ?>