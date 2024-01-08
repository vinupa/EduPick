<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/manage-children-dashboard/style.css" />

<title><?php echo SITENAME; ?> | Manage Children</title>
</head>
<body>

    <div class="children-d">
      <header class="header">
        <div class="navbar">
          <div class="navbar-logo-conatiner">
            <img class="logo-image" src="<?php echo URLROOT; ?>/manage-children-dashboard/logo-image.png" />
            <div class="navbar-logo-text-container">
              <div class="navbar-logo-edupick">EduPick</div>
            </div>
          </div>
          <div class="nav-menu-container">
            <a href=""><button class="nav-menu-text">Home</button></a>
            <a href=""><button class="nav-menu-text">Mange Children</button></a>
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
          Manage your children&#039;s transportation with ease and confidence
          <br><br><br>
          <a style="font-size:14px" href="<?php echo URLROOT; ?>/parents/index">< Back to Dashboard</a>
        </div>
      </header>
      
      <div class="dashboard-table-component">
        
      <a href="<?php echo URLROOT; ?>/parents/addChild">
        <button class="nav-signin">
            <div class="nav-signin-text">+ Add New Child</div>
        </button>
      </a>
        

        <div class="dashboard-table-title">All Children</div>
        <div class="table-container">
          <div class="table-heading">
            <div class="table-heding-group">
              <div class="child-name">Child Name</div>
              <div class="school">School</div>
              <div class="grade">Grade</div>
              <div class="vehicle-owner">Vehicle Owner</div>
              <div class="vehicle-driver">Vehicle Driver</div>
              <div class="delete-edit">Delete/Edit</div>
            </div>
            <div class="line-4"></div>
          </div>
          
          <?php foreach($data['children'] as $child) : ?>
              <div class="table-row-comp2">
                <div class="tabel-row-container">
                  <div class="table-row-text"><?php echo $child->firstName; ?> <?php echo $child->lastName; ?></div>
                  <div class="table-row-text2"><?php echo $child->school; ?></div>
                  <div class="table-row-text3"><?php echo $child->grade; ?></div>
                  <div class="table-row-text4"><?php echo $child->vanID; ?></div>
                  <div class="table-row-text5"><?php echo $child->vanID; ?></div>
                  <div class="table-row-button-container">
                    <a href="<?php echo URLROOT; ?>/parents/removeChild/<?php echo $child->childID ; ?>">
                    <div class="table-row-delete-button">
                      <button class="delete">Delete</button>
                    </div>
                    </a>
                    <a href="<?php echo URLROOT; ?>/parents/updateChild/<?php echo $child->childID ; ?>"><img class="edit" src="<?php echo URLROOT; ?>/manage-children-dashboard/edit.png" /></a>
                  </div>
                </div>
                <div class="line"></div>
              </div>
          <?php endforeach; ?>

          
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
              <img class="facebook2" src="<?php echo URLROOT; ?>/manage-children-dashboard/facebook2.png" />
            </div>
          </div>
          <div class="instagram">
            <div class="instagram-icon">
              <img class="instagram-circle" src="<?php echo URLROOT; ?>/manage-children-dashboard/instagram-circle.png" />
            </div>
          </div>
          <div class="twitter">
            <div class="twitter-icon">
              <img class="twitter2" src="<?php echo URLROOT; ?>/manage-children-dashboard/twitter2.png" />
            </div>
          </div>
        </div>
        <div class="footer-right-container">
          <div class="footer-right-text3">
            <div class="bx-bx-phone">
              <img class="phone" src="<?php echo URLROOT; ?>/manage-children-dashboard/phone.png" />
            </div>
            <div class="h-6">+94112729729</div>
          </div>
          <div class="footer-right-text3">
            <img class="place-marker" src="<?php echo URLROOT; ?>/manage-children-dashboard/place-marker.png" />
            <div class="h-6">
              35 Reid Ave Colombo 007, <br />Sri Lanka
            </div>
          </div>
          <div class="footer-right-text3">
            <img class="envelope" src="<?php echo URLROOT; ?>/manage-children-dashboard/envelope.png" />
            <div class="h-6">edupick@edu.com</div>
          </div>
        </div>
      </div>
    </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>