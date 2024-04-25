<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/parent/style.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<title>
    <?php echo SITENAME; ?> | Add Children
</title>
</head>

<body> 
    <?php require APPROOT . '/views/inc/parentNav.php'; ?>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-user-plus"></i>
                    <span class="text">Add Child Details</span>
                </div>
            </div>

            <div class="goback-link">
                <a href="<?php echo URLROOT; ?>/parents/manageChildren">
                    <i class="uil uil-backward"></i>
                    <span class="text">Back to Dashboard</span>
                </a>
            </div>

            <div class="add-child">
                <form action="<?php echo URLROOT; ?>/parents/addChild" method="POST">
                    <div class="input-box">
                        <span class="details">First Name</span>
                        <input type="text" id="first_name" name="first_name">
                    </div>
                    <div class="input-box">
                        <span class="details">Last Name</span>
                        <input type="text" id="last_name" name="last_name">
                    </div>
                    <div class="input-box">
                        <span class="details">School</span>
                        <select class="" id="school" name="school">
                            <option value="" disabled hidden selected>Select School</option>
                            
                            <?php foreach($data['schools'] as $school): ?>
                                <option value="<?php echo $school->schoolId; ?>"><?php echo $school->name; ?></option>
                            <?php endforeach; ?>

                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">Grade</span>
                        <input type="number" id="grade" name="grade">
                    </div>
                    
                    <!-- error messages -->
                    <div class="auth-err">
                        <p> <?php echo $data['fname_err']; ?></p>
                        <p> <?php echo $data['lname_err']; ?></p>
                        <p> <?php echo $data['school_err']; ?></p>
                        <p> <?php echo $data['grade_err']; ?></p>
                      </div>
                    <div class="submit-button">
                        <input type="submit" value="Add Child">
                    </div>
                </form>
        </div>
    </section>

    <script src="<?php echo URLROOT; ?>/parent/script.js"></script>

    <?php require APPROOT . '/views/inc/footer.php'; ?>