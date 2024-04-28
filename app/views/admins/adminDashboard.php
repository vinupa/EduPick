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

        <div class="activity">
        <div style="display: flex; flex-wrap: wrap;">
            <div style="flex: 1; margin-right: 100px; max-width: 40%;">
                <canvas id="userTypesChart" width="400" height="400"></canvas>
            </div>
            <div style="flex: 1; margin-left: 10px; max-width: 40%;">
                <canvas id="myChart" width="400" height="400"></canvas>
            </div>
        </div>
            <!-- <div style="flex max-height: 400px; max-width: 400px;">
                <canvas id="userTypesChart" width="100" height="100"></canvas>
                <canvas id="myChart" width="100" height="100"></canvas>
            </div> -->
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
                                display: false, // Hide the x-axis
                            },
                            y: {
                                beginAtZero: true,
                                stepSize: 1,
                                precision: 0, // Set precision to 0 to display only integer values
                            }
                        }
                    },
                });


            </script>
        </div>
    </div>
    </section>

    <script src="<?php echo URLROOT; ?>/parent/script.js"></script>

    <?php require APPROOT . '/views/inc/footer.php'; ?>