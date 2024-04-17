<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/Owner.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Register Vehicles</title> 
    <style></style>
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="<?=URLROOT.'/public\img\favicon\logo.png'?>" alt="">
                
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
          <img src="<?=URLROOT.'/public\img\favicon\profile.jpg'?>" alt=""> 
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <span class="text"></span>
                </div>
            </div>
        </div>


    <form action="<?=URLROOT.'/controller1/form?'?>"  method= "post">
      <h2>Register Vehicles</h2>
      <div class="form-group fullname">
        <label for="fullname">Model</label>
        <input type="text" name="features" id="fullname" placeholder="Enter your vehicle model" required>
      </div>

      <div class="form-group fullname">
        <label for="fullname">Licence Plate</label>
        <input type="text" name="licensePlate" id="fullname" placeholder="Enter your licence plate number" required>
      </div>

      <div class="form-group email">
        <label for="email">Total Seats</label>
        <input type="text" name="totalSeats" id="email" placeholder="Enter number of total seats" required>
      </div>

      <div class="form-group password">
        <label for="email">Vacant Seats</label>
        <input type="text" name="vacantSeats" id="email" placeholder="Enter number of vacant seats" required>
      </div>

      <div class="form-group date">
        <label for="date">Schools </label>
        <input type="text" name="schools" id="email" placeholder="Enter the name of Schools" required>
      </div>

      
      <div class="form-group date">
        <label for="date">Cities Covered</label>
        <input type="text" name="cities" id="email" placeholder="Enter the name of cities Covered" required>
      </div>


      <!-- <div class="form-group gender">
        <label for="gender">Vehicle Image</label>
            //<form action="/your-upload-endpoint" method="post" enctype="multipart/form-data"> 
            <label for="image">Select Image:</label> 
            <input type="file" id="image" name="image" accept="image/*"> ////-->
            <!-- <input type="file" name="vehicle" id="image" placeholder="Choose file" required> -->
            <!-- <br><br>

            <div class="form-group gender">
            <label for="gender">Vehicle Insurance Image</label>
            <input type="file" name="insurance" id="image" placeholder="Choose file" required>
            <br> -->

           <!-- <input type="submit" value="Upload Image"> -->
        <!-- </form> -->
       <!-- <select id="gender">
          <option value="" selected disabled>Select your gender</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
          <option value="Other">Other</option>
        </select>-->
     <!-- </div> -->
      <div class="form-group submit-btn">
        <input type="submit" value="Save">
      </div>
    </form>

    <script src="Owner.js"></script>
  </body>
</html>