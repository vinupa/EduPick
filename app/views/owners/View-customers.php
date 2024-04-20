<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/owner/Owner.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<title>
    <?php echo SITENAME; ?> | View Customers
</title>
</head>

<body>
    
    <?php require APPROOT . '/views/inc/ownerNav.php'; ?>

    <!--<section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <h2>Hi, Stephen</h2>
            <img src="images/profile.jpg" alt=""> 
        </div>-->

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-eye"></i>
                    <span class="text">View Customers</span>
                </div>
            

            <div class="activity">
                
                <div class="activity-data">
                    
                    <div class="data type">
                        <span class="data-title">Parent ID</span>
                        <?php foreach ($data['parents'] as $parent): ?>
                            <span class="data-list">
                                <?php echo $parent->parentID; ?>
                            </span>
                        <?php endforeach; ?>
                    </div>

                    <div class="data email">
                        <span class="data-title">First Name</span>
                        <?php foreach ($data['parents'] as $parent): ?>
                            <span class="data-list">
                                <?php echo $parent->firstName; ?>
                            </span>
                        <?php endforeach; ?>
                    </div>

                    <div class="data email">
                        <span class="data-title">City</span>
                        <?php foreach ($data['parents'] as $parent): ?>
                            <span class="data-list">
                                <?php echo $parent->city; ?>
                            </span>
                        <?php endforeach; ?>
                    </div>

                    <div class="data email">
                        <span class="data-title">Contact Number</span>
                        <?php foreach ($data['parents'] as $parent): ?>
                            <span class="data-list">
                                <?php echo $parent->contactNumber; ?>
                            </span>
                        <?php endforeach; ?>
                    </div>

                    <div class="data icons">
                        <span class="data-title">Delete</span>
                        <?php foreach ($data['parents'] as $parent): ?>
                            <span class="data-list">
                                <div class="delete-edit-icons">
                                    <a href="#"
                                        onclick="return confirm('Are you sure you want to remove this parent?');"><i
                                            class="uil uil-trash-alt"></i></a>
                                </div>

                            </span>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
        </section>
    
        <script src="<?php echo URLROOT; ?>/owner/Owner.js"></script>
    
        <?php require APPROOT . '/views/inc/footer.php'; ?>

                    











/////////<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Owner.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Owner Dashboard Panel</title> 
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="images/logo.png" alt="">
            </div>

            <span class="logo_name">EduPick</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="Owner-dashbord.html">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Dahsboard</span>
                </a></li>
                <li><a href="Manage-vehicles.html">
                    <i class="uil uil-chart"></i>
                    <span class="link-name">Manage Vehicles</span>
                </a></li>
                <li><a href="View-drivers.html">
                    <i class="uil uil-eye"></i>
                    <span class="link-name">View Drivers</span>
                </a></li>
                <li><a href="View-customers.html">
                    <i class="uil uil-eye"></i>
                    <span class="link-name">View Customers</span>
                </a></li>
            </ul>
            
            <ul class="logout-mode">
                <li><a href="#">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>

                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                    <span class="link-name">Dark Mode</span>
                </a>

                <div class="mode-toggle">
                  <span class="switch"></span>
                </div>
            </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <h2>Hi, Stephen</h2>
            <img src="images/profile.jpg" alt=""> 
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-eye"></i>
                    <span class="text">View Customers</span>
                </div>

                <!--<div class="boxes">
                    <a href="">
                        <div class="box box1">
                            <i class="uil uil-plus-circle"></i>
                            <span class="text">Add Drivers</span>
                        </div>
                    </a>
                    <!-- <div class="box box2">
                        <i class="uil uil-comments"></i>
                        <span class="text">Comments</span>
                        <span class="number">20,120</span>
                    </div>
                    <div class="box box3">
                        <i class="uil uil-share"></i>
                        <span class="text">Total Share</span>
                        <span class="number">10,120</span>
                    </div> 
                </div>-->
            </div>

            <div class="activity">

                <div class="activity-data">

                    <!--<div class="data names">
                        <span class="data-title">Parent </span><br>
                        <td style="width: 200px; height: 150px;">
                            <img src="images/customer1.jpg" alt="van1" style=" width: 40px; height: 100%; border-radius: 50%">
                            
    
                        </td>
                        <td style="width: 200px; height: 150px;">
                            <img src="images/customer2.jpg" alt="van2" style="width: 40px; height: 100%; border-radius: 50%">
                        </td>
                    </div>-->

                    <div class="data names">
                        <span class="data-title">Parent ID </span>
                        <span class="data-list">P-2345</span>
                        <span class="data-list">P-7335</span>
                    </div>
                    <div class="data email">
                        <span class="data-title">First Name </span> 
                        <span class="data-list">John</span>
                        <span class="data-list">Ken</span>
                    </div>
                    <div class="data joined">
                        <span class="data-title">Last Name</span>
                        <span class="data-list">Daniel</span>
                        <span class="data-list">William</span>
                    </div>

                    <div class="data joined">
                        <span class="data-title">City</span>
                        <span class="data-list">Maradana</span>
                        <span class="data-list">Kotte</span>
                    </div>

                    <div class="data joined">
                        <span class="data-title">Contact Number</span>
                        <span class="data-list">076-8657773</span>
                        <span class="data-list">077-6663254</span>
                    </div>
                    
                    <div class="data icons">
                        <span class="data-title">Delete</span> 
                        <span class="data-list">
                            <div class="delete-edit-icons">
                                <a href=""><i class="uil uil-trash-alt"></i> </a>
                                
                            </div>
                        </span>
                        <span class="data-list">
                            <div class="delete-edit-icons">
                                <a href=""><i class="uil uil-trash-alt"></i> </a>
                                
                            </div>
                        </span>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>

    <script src="Owner.js"></script>
</body>
</html>