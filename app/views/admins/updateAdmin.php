<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/auth/style.css">
<link rel="stylesheet" href="<?php echo URLROOT; ?>/admin-dashboard/style.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<title><?php echo SITENAME; ?> | Update Admin</title>
</head>
<body>
    <?php require APPROOT . '/views/inc/adminNav.php'; ?>
    <div class="dash-content">
        <div class="overview">
            <div class="title">
                <i class="uil uil-envelope"></i>
                <span class="text">Update Admin</span>
            </div>
            
            <section style="display: flex; justify-content: center; height: calc(100vh - 140px);">
                <div class="form_container">
                  <div class="form login_form">
                    <form action="<?php echo URLROOT; ?>/admins/updateAdmin/<?php echo $data['adminID']; ?>" method="POST">
                      <h2>Update</h2>

                      <div class="auth-err">
                        <p><?php echo $data['firstName_err']; ?></p>
                        <p><?php echo $data['lastName_err']; ?></p>
                        <p><?php echo $data['email_err']; ?></p>
                        <p><?php echo $data['contactNumber_err']; ?></p>
                      </div>

                      <div class="input_box">
                        <p>First Name:</p>
                        <input type="text" id="first_name" name="first_name" value="<?php echo $data['firstName']; ?>" />
                      </div>

                      <div class="input_box">
                        <p>Last Name:</p>
                        <input type="text" id="last_name" name="last_name" value="<?php echo $data['lastName']; ?>" />
                      </div>

                      <div class="input_box">
                        <p>Email:</p>
                        <input type="email" id="email" name="email" value="<?php echo $data['email']; ?>" />
                      </div>

                      <div class="input_box">
                        <p>Contact Number:</p>
                        <input type="text" id="contact_number" name="contact_number" value="<?php echo $data['contactNumber']; ?>" />
                      </div>

                      <button class="button" type="submit">Update</button>
                    </form>
                  </div>
                </div>
            </section>
        </div>
    </div>
   </section>

   <script src="<?php echo URLROOT; ?>/parent/script.js"></script>
   <?php require APPROOT . '/views/inc/footer.php'; ?>