<?php require APPROOT . '/views/inc/header.php'; ?>

<link rel="stylesheet" href="<?php echo URLROOT; ?>/auth/style.css">
<title>
    <?php echo SITENAME; ?>
</title>

</head>

<body>
    <header class="header">
        <nav class="navbar">
            <div class="logo-container">
                <img src="<?php echo URLROOT; ?>/auth/logo.png" alt="EduPick Logo" class="logo-img" />
                <h2 class="logo"><a href="index.html"><span style="color: #e44d26;">Edu</span>Pick</a></h2>
            </div>
            
            <div class="buttons">
                <a class="signin" id="form-open" href="<?php echo URLROOT; ?>/users/login/">Sign In</a>
                <a href="<?php echo URLROOT; ?>/users/parentRegister/" class="signup">Sign Up</a>
            </div>
        </nav>
    </header>
    <section class="hero-section">
        <div class="hero">
            <h2>Centralized School Transport System</h2>
            <p>
                Discover our Centralized School Transport System
                ensuring safe, reliable, and hassle-free travel for students
            </p>
            <div class="buttons">
                <a href="<?php echo URLROOT; ?>/users/parentRegister/" class="join">Join Now</a>
                <a href="#" class="learn">Learn More</a>
            </div>
        </div>
        <div class="img">
            <img src="<?php echo URLROOT; ?>/auth/hero-bg.png" alt="hero image" />
        </div>
    </section>
</body>

</html>



<?php require APPROOT . '/views/inc/footer.php'; ?>