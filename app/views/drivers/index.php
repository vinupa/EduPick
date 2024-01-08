<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/driver-dashboard/style.css" />

<title><?php echo SITENAME; ?></title>
</head>
<body>

    <div class="driver-d">
      <header class="header">
        <div class="hero-banner-container">
          <div class="hero-banner-text-container">
            <div class="hero-banner-text-caption">
              Centralized School Transport System
            </div>
            <div class="hero-banner-text-main">25K+ STUDENTS TRUST US</div>
            <div class="hero-banner-text-sub">
              Connecting You to Your Child&#039;s Safe Journey
            </div>
            <div class="hero-banner-buttons-conatiner">
              <a href="">
                <button class="hero-banner-search-button">
                  <div class="btn-text">Explore Now</div>
                </button>
              </a>
              <a href="">
                <button class="hero-banner-learnmore">
                  <div class="btn-text2">Learn More</div>
                </button>
              </a>
            </div>
          </div>
          <div class="hero-banner-image-container">
            <div class="hero-banner-circle"></div>
            <img class="hero-banner-image" src="<?php echo URLROOT; ?>/driver-dashboard/hero-banner-image.png" />
          </div>
        </div>
        <div class="navbar">
          <div class="navbar-logo-conatiner">
            <img class="logo-image" src="<?php echo URLROOT; ?>/driver-dashboard/logo-image.png" />
            <div class="navbar-logo-text-container">
              <div class="navbar-logo-edupick">EduPick</div>
            </div>
          </div>
          <div class="nav-menu-container">
            <a href=""><button class="nav-menu-text">Home</button></a>
            <a href=""><button class="nav-menu-text">Manage Vehicles</button></a>
            <a href=""><button class="nav-menu-text">View Customers</button></a>
            <a href=""><button class="nav-menu-text">View Drivers</button></a>
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
      </header>

      <div class="first-section">
        <div class="first-section-text-component">
          <div class="first-section-text-container">
            <div class="first-section-text-title">Driver Portal</div>
            <div class="first-section-text-sub">
              Efficient Fleet Management at Your Fingertips
            </div>
          </div>
        </div>
        <div class="first-section-cards-container">
          <a href="">
            <div class="first-section-card">
                <div class="first-section-card-icon">
                  <div class="ellipse-shape"></div>
                  <img class="children" src="<?php echo URLROOT; ?>/driver-dashboard/children.png" />
                </div>
              <div class="first-section-card-description-frame">
                <div class="first-section-card-title">View Children</div>
                <div class="first-section-card-line"></div>
                <div class="first-section-card-text">
                  View children&#039;s details
                </div>
              </div>
            </div>
          </a>
          <a href="">
            <div class="first-section-card">
              <div class="first-section-card-icon">
                <div class="ellipse-shape"></div>
                <img class="calender" src="<?php echo URLROOT; ?>/driver-dashboard/calender.png" />
              </div>
              <div class="first-section-card-description-frame">
                <div class="first-section-card-title">View Attendance</div>
                <div class="first-section-card-line"></div>
                <div class="first-section-card-text">
                  View daily attendance of children
                </div>
              </div>
            </div>
          </a>
          <a href="">
            <div class="first-section-card">
              <div class="first-section-card-icon">
                <div class="ellipse-shape"></div>
                <img class="parent" src="<?php echo URLROOT; ?>/driver-dashboard/parent.png" />
              </div>
              <div class="first-section-card-description-frame">
                <div class="first-section-card-title">View Parent</div>
                <div class="first-section-card-line"></div>
                <div class="first-section-card-text">View Parent details</div>
              </div>
            </div>
          </a>
        </div>
      </div>

      <div class="second-section">
        <img class="mother-daughter" src="<?php echo URLROOT; ?>/driver-dashboard/mother-daughter.png" />
        <div class="fade-image"></div>
        <div class="second-section-texts">
          <div class="second-section-text-component">
            <div class="second-section-text-line"></div>
            <div class="second-section-text-title">Enhanced Parent trust</div>
            <div class="second-section-text-desc">
              Send automatic real-time notifications to parents for pickups from
              school, drop-offs, and any vehicle breakdowns.<br /><br />Enhance
              parental trust and provide peace of mind through transparent
              communication.
            </div>
          </div>
          <div class="second-section-text-component2">
            <div class="second-section-text-line"></div>
            <div class="second-section-text-title">
              Efficiency at Your Fingertips
            </div>
            <div class="second-section-text-desc">
              Manage your daily routes and schedules effortlessly from a
              user-friendly dashboard.<br /><br />Streamline your routes and
              schedules based on real-time attendance data.
            </div>
          </div>
        </div>
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
              <img class="facebook2" src="<?php echo URLROOT; ?>/driver-dashboard/facebook2.png" />
            </div>
          </div>
          <div class="instagram">
            <div class="instagram-icon">
              <img class="instagram-circle" src="<?php echo URLROOT; ?>/driver-dashboard/instagram-circle.png" />
            </div>
          </div>
          <div class="twitter">
            <div class="twitter-icon">
              <img class="twitter2" src="<?php echo URLROOT; ?>/driver-dashboard/twitter2.png" />
            </div>
          </div>
        </div>
        <div class="footer-right-container">
          <div class="footer-right-text3">
            <div class="bx-bx-phone">
              <img class="phone" src="<?php echo URLROOT; ?>/driver-dashboard/phone.png" />
            </div>
            <div class="h-6">+94112729729</div>
          </div>
          <div class="footer-right-text3">
            <img class="place-marker" src="<?php echo URLROOT; ?>/driver-dashboard/place-marker.png" />
            <div class="h-6">
              35 Reid Ave Colombo 007, <br />Sri Lanka
            </div>
          </div>
          <div class="footer-right-text3">
            <img class="envelope" src="<?php echo URLROOT; ?>/driver-dashboard/envelope.png" />
            <div class="h-6">edupick@edu.com</div>
          </div>
        </div>
      </div>
    </div>
    
<?php require APPROOT . '/views/inc/footer.php'; ?>
