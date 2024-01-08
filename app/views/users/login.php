<?php require APPROOT . '/views/inc/header.php'; ?>

<link rel="stylesheet" href="<?php echo URLROOT; ?>/login/style.css">
<title><?php echo SITENAME; ?> | Login</title>

  </head>
  <body>
    <div class="login-user">
      <header class="header">
        <div class="navbar">
          <div class="navbar-logo-conatiner">
            <img class="logo-image" src="<?php echo URLROOT; ?>/login/logo-image.png" />
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
    
      <div class="login-root-container">
        <div class="login-title">Log In to Your Account</div>
        <form class="login-contatiner" action="<?php echo URLROOT; ?>/users/login" method="POST">
        <br><?php flash('register_success'); ?>
          <div class="login-container-sub">
            <div class="form-text-component">
              <label class="form-text" for="username">Email</label>
              <input class="form-input-container" type="email" id="email" name="email" value="<?php echo $data['email']; ?>">
            </div>
            <div class="form-text-component">
              <div class="form-text">Password</div>
              <input class="form-input-container" type="password" id="password" name="password" placeholder="********">
            </div>
          </div>
          <div class="login-click-container">
            <div class="login-click-container-sub">
                <div class="login-button">
                  <button class="log-in" type="submit">Login</button>
                </div>
              <div class="login-direct-text">
                <span>
                  <span class="login-direct-text-span">Don’t have an account ? </span>
                  <a href="<?php echo URLROOT; ?>/users/parentRegister/"><span class="login-direct-text-span2">Click here to register</span></a>
                </span>
              </div>
            </div>
                <p style="color:red"> <?php echo $data['email_err']; ?></p>
                <p style="color:red"> <?php echo $data['password_err']; ?></p>
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
              <img class="facebook2" src="<?php echo URLROOT; ?>/login/facebook2.png" />
            </div>
          </div>
          <div class="instagram">
            <div class="instagram-icon">
              <img class="instagram-circle" src="<?php echo URLROOT; ?>/login/instagram-circle.png" />
            </div>
          </div>
          <div class="twitter">
            <div class="twitter-icon">
              <img class="twitter2" src="<?php echo URLROOT; ?>/login/twitter2.png" />
            </div>
          </div>
        </div>
        <div class="footer-right-container">
          <div class="footer-right-text3">
            <div class="bx-bx-phone">
              <img class="phone" src="<?php echo URLROOT; ?>/login/phone.png" />
            </div>
            <div class="h-6">+94112729729</div>
          </div>
          <div class="footer-right-text3">
            <img class="place-marker" src="<?php echo URLROOT; ?>/login/place-marker.png" />
            <div class="h-6">
              35 Reid Ave Colombo 007, <br />Sri Lanka
            </div>
          </div>
          <div class="footer-right-text3">
            <img class="envelope" src="<?php echo URLROOT; ?>/login/envelope.png" />
            <div class="h-6">edupick@edu.com</div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>



<?php require APPROOT . '/views/inc/footer.php'; ?>