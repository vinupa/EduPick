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
        <div class="form_container">
            <div class="form login_form">
                <form action="<?php echo URLROOT; ?>/users/verify" method="POST">
                    <h2>Enter OTP</h2>
                    <div class="auth-err">
                        <p> <?php echo isset($data['code_err']) ? $data['code_err'] : ''; ?></p>
                    </div>

                    <div class="verify-msg">
                        Please enter the 6 digit One Time Password (OTP) sent to your email address to complete your account verification.
                    </div>

                    <div class="input_box">
                        <p>Verification Code:</p>
                        <input type="text" inputmode="numeric" placeholder="******" id="code" name="code" maxlength="6" required />
                    </div>

                    <button class="button" type="submit">Verify</button>
                </form>
            </div>
        </div>
    </section>

    <?php require APPROOT . '/views/inc/footer.php'; ?>