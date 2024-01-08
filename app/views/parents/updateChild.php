<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/update-child/style.css" />

<title><?php echo SITENAME; ?> | Update Child</title>
</head>
<body>

    <div class="children-d">
      <header class="header">
        <div class="navbar">
          <div class="navbar-logo-conatiner">
            <img class="logo-image" src="<?php echo URLROOT; ?>/update-child/logo-image.png" />
            <div class="navbar-logo-text-container">
              <div class="navbar-logo-edupick">EduPick</div>
            </div>
          </div>
          <div class="nav-menu-container">
            <a href=""><button class="nav-menu-text">Home</button></a>
            <a href=""><button class="nav-menu-text">Manage Children</button></a>
            <a href=""><button class="nav-menu-text">Search Vehicles</button></a>
            <a href=""><button class="nav-menu-text">View Vehicles</button></a>
          </div>
          <div class="nav-auth-container">
          <button class="login-text"><?php echo $_SESSION['user_fname'] ; ?></button>
            <a href="<?php echo URLROOT; ?>/users/logout">
              <button class="nav-signin">
                <div class="nav-signin-text">SIGN OUT</div>
              </button>
            </a>
          </div>
        </div>
        <div class="hello-evano">Hello <?php echo $_SESSION['user_fname'] ; ?> 👋🏼</div>
        <div class="hero-banner-text-sub">
          Manage your children's transportation with ease and confidence
          <br><br><br>
          <a style="font-size:14px" href="<?php echo URLROOT; ?>/parents/manageChildren">< Back to Management Portal</a>
          </div>
      </header>
      
      <div class="login-root-container">
        <div class="login-title">Update Child Details</div>
        <form class="login-contatiner" action="<?php echo URLROOT; ?>/parents/updateChildPost/" method="POST">
          <div class="login-container-sub">
            <div class="form-text-component">
              <label class="form-text" for="first_name">First Name</label>
              <input class="form-input-container" type="text" id="first_name" name="first_name" value="<?php echo $data['firstName'] ?>" required>
            </div>
            <div class="form-text-component">
              <label class="form-text" for="last_name">Last Name</label>
              <input class="form-input-container" type="text" id="last_name" name="last_name" value="<?php echo $data['lastName'] ?>" required>
            </div>
            <div class="form-text-component">
              <label class="form-text" for="school">School</label>
              <select class="form-input-container" id="school" name="school">
                <option value="" disabled hidden>Select School</option>
                <option value="Royal College, Colombo" <?php echo ($data['school'] == 'Royal College, Colombo') ? 'selected' : ''?>>Royal College, Colombo</option>
                <option value="Ananda College, Colombo"<?php echo ($data['school'] == 'Ananda College, Colombo') ? 'selected' : ''?>>Ananda College, Colombo</option>
                <option value="Thurstan College, Colombo"<?php echo ($data['school'] == 'Thurstan College, Colombo') ? 'selected' : ''?>>Thurstan College, Colombo</option>
              </select>
            </div>
            <div class="form-text-component">
              <label class="form-text" for="grade">Grade</label>
              <input class="form-input-container" type="number" id="grade" name="grade" value="<?php echo $data['grade'] ?>" required>
            </div>
            <input type="hidden" name="child_id" value="<?php echo $data['child_id'] ?>">
          </div>
          <div class="signin-click-container">
            <div class="signin-click-container-sub">
                <div class="signin-button">
                  <button class="sign-in" type="submit">Update</button>
                </div>
            </div>
          </div>
        </form>
      </div>

      <div class="footer">
        <div class="footer-right">
          <div class="footer-right-text">Get In Touch</div>
          <div class="footer-right-text2">About Us</div>
          <div class="footer-right-text2">Contact Us</div>
          <div class="footer-right-text2">EduPick ©</div>
        </div>
        <div class="footer-social-icons-container">
          <div class="facebook">
            <div class="facebook-icon">
              <img class="facebook2" src="<?php echo URLROOT; ?>/update-child/facebook2.png" />
            </div>
          </div>
          <div class="instagram">
            <div class="instagram-icon">
              <img class="instagram-circle" src="<?php echo URLROOT; ?>/update-child/instagram-circle.png" />
            </div>
          </div>
          <div class="twitter">
            <div class="twitter-icon">
              <img class="twitter2" src="<?php echo URLROOT; ?>/update-child/twitter2.png" />
            </div>
          </div>
        </div>
        <div class="footer-right-container">
          <div class="footer-right-text3">
            <div class="bx-bx-phone">
              <img class="phone" src="<?php echo URLROOT; ?>/update-child/phone.png" />
            </div>
            <div class="h-6">+94112729729</div>
          </div>
          <div class="footer-right-text3">
            <img class="place-marker" src="<?php echo URLROOT; ?>/update-child/place-marker.png" />
            <div class="h-6">
              35 Reid Ave Colombo 007, <br />Sri Lanka
            </div>
          </div>
          <div class="footer-right-text3">
            <img class="envelope" src="<?php echo URLROOT; ?>/update-child/envelope.png" />
            <div class="h-6">edupick@edu.com</div>
          </div>
        </div>
      </div>
    </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>