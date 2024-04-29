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
            <?php flash('register_success'); ?>
                <form action="<?php echo URLROOT; ?>/users/registered" method="POST">
                    <h2>Verify Email</h2>

                    <div class="verify-msg">
                        Please verify your Email address to complete your registration on the EduPick platform.
                        <br><br>
                        By clicking the button below, a verification code will be sent to your email address.
                    </div>

                    <button class="button" type="submit" style="margin-top: 0px;">Send Email</button>
                </form>
            </div>
        </div>
    </section>

    <?php require APPROOT . '/views/inc/footer.php'; ?>