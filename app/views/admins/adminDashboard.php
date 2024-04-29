<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/admin-dashboard/style.css" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/admin-dashboard/approvalRequestStyle.css" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/parent/style.css" />   
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<title>
    <?php echo SITENAME; ?> | Admin Dashboard
</title>
</head>

<body>

    <?php require APPROOT . '/views/inc/adminNav.php'; ?>

    <div class="dash-content">
        <div class="overview">
            <div class="title">
                <i class="uil uil-tachometer-fast-alt"></i>
                <span class="text">Dashboard</span>
            </div>
        </div>

        <div>
            <div style="display: flex; flex-wrap: wrap;">
                <div style="flex: 1; margin-right: 100px; max-width: 40%;">
                    <canvas id="userTypesChart" width="400" height="400"></canvas>
                </div>
                <div style="flex: 1; margin-left: 10px; max-width: 40%;">
                    <canvas id="myChart" width="400" height="400"></canvas>
                </div>
            </div>

            <script>
                const userTypesData = {
                    labels: [
                        'Parents',
                        'Owners',
                        'Drivers'
                    ],
                    datasets: [{
                        data: [<?php echo $data['parentCount']; ?>, <?php echo $data['ownerCount']; ?>, <?php echo $data['driverCount']; ?>],
                        backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                        ],
                        hoverOffset: 4
                    }]
                };

                // Render pie chart using Chart.js
                var userTypesChart = new Chart(document.getElementById('userTypesChart'), {
                    type: 'doughnut',
                    data: userTypesData,
                    options: {
                        responsive: true,
                        plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Number of users',
                            font: {
                                    size: 16
                            }
                        }
                        }
                    },
                });
                
                var registrationData = <?php echo json_encode($data['registrationData']); ?>;

                registrationData = registrationData.map(row => ({...row, date: new Date(row.date * 1000) }));

                // Format the data for Chart.js
                const formattedData = {
                    labels: registrationData.map(row => row.date),
                    datasets: [
                        {
                            label: 'Parents',
                            data: registrationData.map(row => row.parents),
                            borderColor: 'rgba(255, 99, 132, 1)',
                            backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        },
                        {
                            label: 'Owners',
                            data: registrationData.map(row => row.owners),
                            borderColor: 'rgba(54, 162, 235, 1)',
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        },
                        {
                            label: 'Drivers',
                            data: registrationData.map(row => row.drivers),
                            borderColor: 'rgba(255, 206, 86, 1)',
                            backgroundColor: 'rgba(255, 206, 86, 0.5)',
                        },
                    ],
                };

                console.log(registrationData)

                // Render the line chart using Chart.js
                const ctx = document.getElementById('myChart').getContext('2d');
                const registrationChart = new Chart(ctx, {
                    type: 'line',
                    data: formattedData,
                    options: {
                        responsive: true,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Number of registered users (last 30 days)',
                                font: {
                                    size: 16
                                }
                            }
                        },
                        scales: {
                            x: {
                                display: false, 
                            },
                            y: {
                                beginAtZero: true,
                                stepSize: 1,
                                precision: 0, 
                            }
                        }
                    },
                });


            </script>
        </div>
        <div>
            <div>
                <div class="parent-registration-data">
                    <div class="title">
                        <i class="uil uil-users-alt"></i>
                        <span class="text">Parent Registration Data</span>
                    </div>
                    <div class="date-filter" style="margin-bottom: 30px; margin-left: 15px;">
                        <form method="post" action="<?php echo URLROOT; ?>/admins/adminDashboard">
                            <label for="from_date">From:</label>
                            <input type="date" id="from_date" name="from_date" value="<?php echo isset($_POST['from_date']) ? $_POST['from_date'] : ''; ?>" required>
                            <label for="to_date">To:</label>
                            <input type="date" id="to_date" name="to_date" value="<?php echo isset($_POST['to_date']) ? $_POST['to_date'] : ''; ?>" required>
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </form>
                    </div>

                    <div class="activity" style = "margin-bottom: 50px">
                        <div class="activity-data">
                            <?php if (isset($data['parentRegistrationData'])) : ?>
                                <div class="data names">
                                    <span class="data-title">Parent Name</span>
                                    <?php foreach ($data['parentRegistrationData'] as $parent) : ?>
                                        <span class="data-list" style="margin-left: 5px;">
                                            <?php echo $parent->firstName; ?>
                                            <?php echo $parent->lastName; ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                                <div class="data email">
                                    <span class="data-title">Email</span>
                                    <?php foreach ($data['parentRegistrationData'] as $parent) : ?>
                                        <span class="data-list">
                                            <?php echo $parent->email; ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                                <div class="data joined">
                                    <span class="data-title">Contact Number</span>
                                    <?php foreach ($data['parentRegistrationData'] as $parent) : ?>
                                        <span class="data-list data-grade">
                                            <?php echo $parent->contactNumber; ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                                <div class="data type">
                                    <span class="data-title">Registration Date</span>
                                    <?php foreach ($data['parentRegistrationData'] as $parent) : ?>
                                        <span class="data-list" style="margin-left: 15px;">
                                            <?php echo date('Y-m-d', strtotime($parent->regDate)); ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            <?php else : ?>
                                <tr>
                                    <td colspan="7">No parent registration data found.</td>
                                </tr>
                            <?php endif; ?>
                        </div>
                    </div>   

                    <div style="width: 100%; height: 1px; background-color: #000; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); margin-bottom: 40px;"></div>
                    <div class="title">
                        <i class="uil uil-streering"></i>
                        <span class="text">Driver Registration Data</span>
                    </div>                
                    <div class="activity" style = "margin-bottom: 50px">
                        <div class="activity-data">
                            <?php if (isset($data['driverRegistrationData'])) : ?>
                                <div class="data names" style="margin-bottom: 15px;">
                                    <span class="data-title">Driver Name</span>
                                    <?php foreach ($data['driverRegistrationData'] as $driver) : ?>
                                        <span class="data-list" style="margin-left: 5px;">
                                            <?php echo $driver->firstName; ?>
                                            <?php echo $driver->lastName; ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                                <div class="data email">
                                    <span class="data-title">Email</span>
                                    <?php foreach ($data['driverRegistrationData'] as $driver) : ?>
                                        <span class="data-list">
                                            <?php echo $driver->email; ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                                <div class="data joined">
                                    <span class="data-title">Contact Number</span>
                                    <?php foreach ($data['driverRegistrationData'] as $driver) : ?>
                                        <span class="data-list data-grade">
                                            <?php echo $driver->contactNumber; ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                                <div class="data type">
                                    <span class="data-title">Registration Date</span>
                                    <?php foreach ($data['driverRegistrationData'] as $driver) : ?>
                                        <span class="data-list" style="margin-left: 15px;">
                                            <?php echo date('Y-m-d', strtotime($driver->regDate)); ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            <?php else : ?>
                                <tr>
                                    <td colspan="7">No driver registration data found.</td>
                                </tr>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div style="width: 100%; height: 1px; background-color: #000; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); margin-bottom: 40px;"></div>
                    <div class="title">
                        <i class="uil uil-users-alt"></i>
                        <span class="text">Owner Registration Data</span>
                    </div>                
                    <div class="activity" style = "margin-bottom: 50px">
                        <div class="activity-data">
                            <?php if (isset($data['ownerRegistrationData'])) : ?>
                                <div class="data names" style="margin-bottom: 15px;">
                                    <span class="data-title">Owner Name</span>
                                    <?php foreach ($data['ownerRegistrationData'] as $owner) : ?>
                                        <span class="data-list" style="margin-left: 5px;">
                                            <?php echo $owner->firstName; ?>
                                            <?php echo $owner->lastName; ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                                <div class="data email">
                                    <span class="data-title">Email</span>
                                    <?php foreach ($data['ownerRegistrationData'] as $owner) : ?>
                                        <span class="data-list">
                                            <?php echo $owner->email; ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                                <div class="data joined">
                                    <span class="data-title">Contact Number</span>
                                    <?php foreach ($data['ownerRegistrationData'] as $owner) : ?>
                                        <span class="data-list data-grade">
                                            <?php echo $owner->contactNumber; ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                                <div class="data type">
                                    <span class="data-title">Registration Date</span>
                                    <?php foreach ($data['ownerRegistrationData'] as $owner) : ?>
                                        <span class="data-list" style="margin-left: 15px;">
                                            <?php echo date('Y-m-d', strtotime($owner->regDate)); ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            <?php else : ?>
                                <tr>
                                    <td colspan="7">No owner registration data found.</td>
                                </tr>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div style="width: 100%; height: 1px; background-color: #000; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); margin-bottom: 40px;"></div>
                    <div class="title">
                        <i class="uil uil-folder-download"></i>
                        <span class="text">Export Data</span>
                    </div>
                    <div class="date-filter" style="margin-bottom: 30px; margin-left: 15px;">
                        <form method="post" action="<?php echo URLROOT; ?>/admins/exportPDF">
                            <label for="from_date">From:</label>
                            <input type="date" id="from_date" name="from_date" required>
                            <label for="to_date">To:</label>
                            <input type="date" id="to_date" name="to_date" required>
                            <button type="submit" class="btn btn-primary">Export PDF</button>
                        </form>
                    </div>            
                    <div class="activity">
                        <div class="activity-data">

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </section>

    <script src="<?php echo URLROOT; ?>/parent/script.js"></script>
    

    <?php require APPROOT . '/views/inc/footer.php'; ?>