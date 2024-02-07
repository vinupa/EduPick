<?php require APPROOT . '/views/inc/header.php'; ?>

<link rel="stylesheet" href="<?php echo URLROOT; ?>/auth/style.css">
<title><?php echo SITENAME; ?> | Login</title>

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
          <a href="<?php echo URLROOT; ?>/users/parentRegister/" class="signup">Sign Up</a>
        </div>
      </nav>
    </header>

    <section class="home">
        <d  iv class="form_container">
          <!-- Login Form -->
          <div class="form login_form">
            <form action="<?php echo URLROOT; ?>/users/login" method="POST">
              <h2>Login</h2>
              <br><?php flash('register_success'); ?>
              <div class="auth-err">
                <p> <?php echo $data['email_err']; ?></p>
                <p> <?php echo $data['password_err']; ?></p>
              </div>

              <div class="input_box">
                <p>Email:</p>
                <input type="email" placeholder="email@example.com" id="email" name="email" required />
              </div>
              <div class="input_box">
                <p>Password:</p>
                <input type="password" placeholder="**********" id="password" name="password" required />
              </div>
  
              <!-- <div class="option_field">
                <span class="checkbox">
                  <input type="checkbox" id="check" />
                  <label for="check">Remember me</label>
                </span>
                <a href="#" class="forgot_pw">Forgot password?</a>
              </div> -->
              
              <button class="button" type="submit">Login Now</button>
  
              <div class="login_signup">Don't have an account? <a href="<?php echo URLROOT; ?>/users/parentRegister/" id="signup">Signup</a></div>
            </form>
          </div>
        </div>
      </section>

<?php require APPROOT . '/views/inc/footer.php'; ?>