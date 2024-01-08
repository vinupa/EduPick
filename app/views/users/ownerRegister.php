<?php require APPROOT . '/views/inc/header.php'; ?>

<link rel="stylesheet" href="<?php echo URLROOT; ?>/owner-register/style.css">
<title><?php echo SITENAME; ?> | Register</title>

  </head>
  <body>
    <div class="owner-register">
      <header class="header">
        <div class="navbar">
          <div class="navbar-logo-conatiner">
            <img class="logo-image" src="<?php echo URLROOT; ?>/owner-register/logo-image.png" />
            <div class="navbar-logo-text-container">
              <div class="navbar-logo-edupick">EduPick</div>
            </div>
          </div>
        </div>
        <div class="hello">Hello 👋🏼</div>
        <div class="hero-banner-text-sub">
          Join our school transportation system to ensure a safe and efficient
          commute for your children. We&#039;re here to make your child&#039;s
          journey to school worry-free.
        </div>
      </header>
      
      <div class="toggle-container">
        <img class="toggle-container-rectangle-l" src="<?php echo URLROOT; ?>/owner-register/toggle-container-rectangle-l.png"/>
        <img class="toggle-container-rectangle"src="<?php echo URLROOT; ?>/owner-register/toggle-container-rectangle.png"/>
        <a href="<?php echo URLROOT; ?>/users/parentRegister/">
          <div class="toggle-text">Parent</div>
        </a>
        <a href="<?php echo URLROOT; ?>/users/ownerRegister/">
          <div class="toggle-text2">Vehicle Owner</div>
        </a>
        <a href="<?php echo URLROOT; ?>/users/driverRegister/">
          <div class="toggle-text3">Driver</div>
        </a>
      </div>

      <div class="login-root-container">
        <div class="login-title">Create a Vehicle Owner Account</div>

        <form class="login-contatiner" action="<?php echo URLROOT; ?>/users/ownerRegister" method="POST">
          <div class="login-container-sub">
            <div class="form-text-component">
              <label class="form-text" for="first_name">First Name</label>
              <input class="form-input-container" type="text" id="first_name" name="first_name" value="<?php echo $data['fname']; ?>">
            </div>
            <div class="form-text-component">
              <label class="form-text" for="last_name">Last Name</label>
              <input class="form-input-container" type="text" id="last_name" name="last_name" value="<?php echo $data['lname']; ?>">
            </div>
            <div class="form-text-component">
              <label class="form-text" for="email">Email</label>
              <input class="form-input-container" type="email" id="email" name="email" value="<?php echo $data['email']; ?>">
            </div>
            <div class="form-text-component">
              <div class="form-text">Password</div>
              <input class="form-input-container" type="password" id="password" name="password" value="<?php echo $data['password']; ?>">
            </div>
            <div class="form-text-component">
              <div class="form-text">Confirm Password</div>
              <input class="form-input-container" type="password" id="confirm-password" name="confirm-password" value="<?php echo $data['confirm_password']; ?>">
            </div>
            <div class="form-text-component">
              <label class="form-text" for="mobile_number">Mobile Number</label>
              <input class="form-input-container" type="text" id="mobile_number" name="mobile_number" value="<?php echo $data['contact_number']; ?>">
            </div>
          </div>
          <div class="signin-click-container">
            <div class="signin-click-container-sub">
                <div class="signin-button">
                  <button class="sign-in" type="submit">Register</button>
                </div>
              <div class="login-direct-text">
                <span>
                  <span class="login-direct-text-span">Already have an account ? </span>
                  <a href="<?php echo URLROOT; ?>/users/login"><span class="login-direct-text-span2">Click here to login</span></a>
                </span>
              </div>
            </div>

                <p style="color:red"> <?php echo $data['fname_err']; ?></p>
                <p style="color:red"> <?php echo $data['lname_err']; ?></p>
                <p style="color:red"> <?php echo $data['email_err']; ?></p>
                <p style="color:red"> <?php echo $data['password_err']; ?></p>
                <p style="color:red"> <?php echo $data['confirm_password_err']; ?></p>
                <p style="color:red"> <?php echo $data['contact_number_err']; ?></p>
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
              <img class="facebook2" src="<?php echo URLROOT; ?>/owner-register/facebook2.png" />
            </div>
          </div>
          <div class="instagram">
            <div class="instagram-icon">
              <img class="instagram-circle" src="<?php echo URLROOT; ?>/owner-register/instagram-circle.png" />
            </div>
          </div>
          <div class="twitter">
            <div class="twitter-icon">
              <img class="twitter2" src="<?php echo URLROOT; ?>/owner-register/twitter2.png" />
            </div>
          </div>
        </div>
        <div class="footer-right-container">
          <div class="footer-right-text3">
            <div class="bx-bx-phone">
              <img class="phone" src="<?php echo URLROOT; ?>/owner-register/phone.png" />
            </div>
            <div class="h-6">+94112729729</div>
          </div>
          <div class="footer-right-text3">
            <img class="place-marker" src="<?php echo URLROOT; ?>/owner-register/place-marker.png" />
            <div class="h-6">
              35 Reid Ave Colombo 007, <br />Sri Lanka
            </div>
          </div>
          <div class="footer-right-text3">
            <img class="envelope" src="<?php echo URLROOT; ?>/owner-register/envelope.png" />
            <div class="h-6">edupick@edu.com</div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>



<?php require APPROOT . '/views/inc/footer.php'; ?>