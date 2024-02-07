<?php require APPROOT . '/views/inc/header.php'; ?>

<link rel="stylesheet" href="<?php echo URLROOT; ?>/auth/style.css">
<title><?php echo SITENAME; ?> | Register</title>

  </head>

  <body>
    <header class="header">
      <nav class="navbar">
        <div class="logo-container">
          <img src="<?php echo URLROOT; ?>/auth/logo.png" alt="EduPick Logo" class="logo-img" />
          <h2 class="logo"><a href="#"><span style="color: #e44d26;">Edu</span>Pick</a></h2>
        </div>
        
        <div class="buttons">
          <a class="signin" id="form-open" href="<?php echo URLROOT; ?>/users/index/">Home</a>
          <a href="<?php echo URLROOT; ?>/users/login/" class="signup">Sign In</a>
        </div>
      </nav>
    </header>

    <section class="home-reg">
        <d  iv class="form_container">
          <!-- Register Form -->
          <div class="form login_form">
            <form action="<?php echo URLROOT; ?>/users/driverRegister" method="POST">
              <h2>Register</h2>
 
              <div class="toggle">
                <a class="toggle-element" href="<?php echo URLROOT; ?>/users/parentRegister/">Parent</a>
                <a class="toggle-element" href="<?php echo URLROOT; ?>/users/ownerRegister/">Vehicle Owner</a>
                <a class="toggle-element toggle-active" href="<?php echo URLROOT; ?>/users/driverRegister/">Driver</a>
              </div>

              <div class="auth-err">
                <p><?php echo $data['fname_err']; ?></p>
                <p><?php echo $data['lname_err']; ?></p>
                <p><?php echo $data['email_err']; ?></p>
                <p><?php echo $data['password_err']; ?></p>
                <p><?php echo $data['confirm_password_err']; ?></p>                
                <p><?php echo $data['address_err']; ?></p>
                <p><?php echo $data['contact_number_err']; ?></p>
              </div>

              <div class="input_box">
                <p>First Name:</p>
                <input type="text" id="first_name" name="first_name" value="<?php echo $data['fname']; ?>" />
              </div>

              <div class="input_box">
                <p>Last Name:</p>
                <input type="text" id="last_name" name="last_name" value="<?php echo $data['lname']; ?>" />
              </div>

              <div class="input_box">
                <p>Email:</p>
                <input type="email" id="email" name="email" value="<?php echo $data['email']; ?>" />
              </div>

              <div class="input_box">
                <p>Password:</p>
                <input type="password" id="password" name="password" value="<?php echo $data['password']; ?>" />
              </div>

              <div class="input_box">
                <p>Confirm Password:</p>
                <input type="password" id="confirm-password" name="confirm-password" value="<?php echo $data['confirm_password']; ?>" />
              </div>
              
              <div class="input_box">
                <p>Address:</p>
                <input type="text" id="address" name="address" value="<?php echo $data['address']; ?>" />
              </div>
  
              <div class="input_box">
                <p>Mobile Number:</p>
                <input type="text" id="mobile_number" name="mobile_number" value="<?php echo $data['contact_number']; ?>" />
              </div>
              
              <button class="button" type="submit">Register</button>
  
              <div class="login_signup">Already have an account? <a href="<?php echo URLROOT; ?>/users/login/" id="signup">Login</a></div>
            </form>
          </div>
        </div>
      </section>


<?php require APPROOT . '/views/inc/footer.php'; ?>
