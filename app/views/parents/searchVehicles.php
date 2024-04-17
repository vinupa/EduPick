<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/parent/style.css" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/parent/searchVehiclesStyle.css" />
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<title>
    <?php echo SITENAME; ?> | Find Vehicle
</title>
</head>

<body>

    <?php require APPROOT . '/views/inc/parentNav.php'; ?>

    <div class="dash-content">

        <div class="overview">
            <div class="title">
                <i class="uil uil-search"></i>
                <span class="text">Search for Vehicles</span>
            </div>
            <div class="selected-child">
                <div class="child-details">
                    <i class="uil uil-user-square"></i>
                    <div class="child-name"><?php echo $_SESSION['childName']; ?></div>
                </div>
                <div class="change-child">
                    <a href="<?php echo URLROOT; ?>/parents/selectChild">
                        <i class="uil uil-exchange"></i>
                        Select Child
                    </a>
                </div>
            </div>
        </div>

        <div class="location-line">
            <span class="text">
                Searching for Vehicles commuting between&nbsp;
            </span>
            <div class="location-name">
                <i class="uil uil-map-marker"></i>
                <span class="name">
                    <?php echo $data['parent']->city; ?>
                </span>
            </div>
            <span class="text">&nbsp;and&nbsp;</span>
            <div class="location-name">
                <i class="uil uil-map-pin-alt"></i>
                <span class="name">
                    <?php echo $_SESSION['childSchool']; ?>
                </span>
            </div>
        </div>

        <div class="filters">
            <span class="text">Filters:</span>
            <div class="filter">
                <input type="checkbox" id="ac" name="ac" value="ac" class="filter-input">
                <label for="ac">A/C</label>
            </div>
            <div class="filter">
                <input type="checkbox" id="highroof" name="highroof" value="highroof" class="filter-input">
                <label for="highroof">High Roof</label>
            </div>
        </div>

        <div class="vehicle-list">

            <div class="vehicle-card">
                <div class="vehicle-image">
                    <img src="<?php echo URLROOT; ?>/public/img/van-sample-image.jpg" alt="Vehicle Image">
                </div>
                <div class="vehicle-details">
                    <span class="vehicle-text" style="font-size: large;">
                        <b>Toyota Hiace</b>
                    </span>
                    <span class="vehicle-text">
                        Model Year: 2014
                    </span>
                </div>
                <div class="vehicle-details">
                    <span class="vehicle-text">
                        <i class="uil uil-users-alt"></i>
                        <b>Seats:&nbsp;</b>
                        14
                    </span>
                    <span class="vehicle-text">
                        <i class="uil uil-wind"></i>
                        <b>A/C:&nbsp;</b>
                        Yes
                    </span>
                </div>
                <div class="vehicle-details">
                    <span class="vehicle-text">
                        <b>Owner:&nbsp;</b>
                        Saman Kumara
                    </span>
                    <span class="vehicle-text">
                        <b>High-Roof:&nbsp;</b>
                        Yes
                    </span>
                </div>
                <div class="vehicle-variables">
                    <input type="checkbox" class="vehicle-variable-ac" checked>
                    <input type="checkbox" class="vehicle-variable-hr" checked>
                </div>
                <div class="vehicle-details">
                    <div class="connect-button">
                        <a href="#">
                            Connect&nbsp;
                            <i class="uil uil-step-forward"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="vehicle-card">
                <div class="vehicle-image">
                    <img src="<?php echo URLROOT; ?>/public/img/van-sample-image.jpg" alt="Vehicle Image">
                </div>
                <div class="vehicle-details">
                    <span class="vehicle-text" style="font-size: large;">
                        <b>Toyota Hiace</b>
                    </span>
                    <span class="vehicle-text">
                        Model Year: 2014
                    </span>
                </div>
                <div class="vehicle-details">
                    <span class="vehicle-text">
                        <i class="uil uil-users-alt"></i>
                        <b>Seats:&nbsp;</b>
                        14
                    </span>
                    <span class="vehicle-text">
                        <i class="uil uil-wind"></i>
                        <b>A/C:&nbsp;</b>
                        No
                    </span>
                </div>
                <div class="vehicle-details">
                    <span class="vehicle-text">
                        <b>Owner:&nbsp;</b>
                        Saman Kumara
                    </span>
                    <span class="vehicle-text">
                        <b>High-Roof:&nbsp;</b>
                        Yes
                    </span>
                </div>
                <div class="vehicle-variables">
                    <input type="checkbox" class="vehicle-variable-ac">
                    <input type="checkbox" class="vehicle-variable-hr" checked>
                </div>
                <div class="vehicle-details">
                    <div class="connect-button">
                        <a href="#">
                            Connect&nbsp;
                            <i class="uil uil-step-forward"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="vehicle-card">
                <div class="vehicle-image">
                    <img src="<?php echo URLROOT; ?>/public/img/van-sample-image.jpg" alt="Vehicle Image">
                </div>
                <div class="vehicle-details">
                    <span class="vehicle-text" style="font-size: large;">
                        <b>Toyota Hiace</b>
                    </span>
                    <span class="vehicle-text">
                        Model Year: 2014
                    </span>
                </div>
                <div class="vehicle-details">
                    <span class="vehicle-text">
                        <i class="uil uil-users-alt"></i>
                        <b>Seats:&nbsp;</b>
                        14
                    </span>
                    <span class="vehicle-text">
                        <i class="uil uil-wind"></i>
                        <b>A/C:&nbsp;</b>
                        Yes
                    </span>
                </div>
                <div class="vehicle-details">
                    <span class="vehicle-text">
                        <b>Owner:&nbsp;</b>
                        Saman Kumara
                    </span>
                    <span class="vehicle-text">
                        <b>High-Roof:&nbsp;</b>
                        No
                    </span>
                </div>
                <div class="vehicle-variables">
                    <input type="checkbox" class="vehicle-variable-ac" checked>
                    <input type="checkbox" class="vehicle-variable-hr">
                </div>
                <div class="vehicle-details">
                    <div class="connect-button">
                        <a href="#">
                            Connect&nbsp;
                            <i class="uil uil-step-forward"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="vehicle-card">
                <div class="vehicle-image">
                    <img src="<?php echo URLROOT; ?>/public/img/van-sample-image.jpg" alt="Vehicle Image">
                </div>
                <div class="vehicle-details">
                    <span class="vehicle-text" style="font-size: large;">
                        <b>Toyota Hiace</b>
                    </span>
                    <span class="vehicle-text">
                        Model Year: 2014
                    </span>
                </div>
                <div class="vehicle-details">
                    <span class="vehicle-text">
                        <i class="uil uil-users-alt"></i>
                        <b>Seats:&nbsp;</b>
                        14
                    </span>
                    <span class="vehicle-text">
                        <i class="uil uil-wind"></i>
                        <b>A/C:&nbsp;</b>
                        No
                    </span>
                </div>
                <div class="vehicle-details">
                    <span class="vehicle-text">
                        <b>Owner:&nbsp;</b>
                        Saman Kumara
                    </span>
                    <span class="vehicle-text">
                        <b>High-Roof:&nbsp;</b>
                        No
                    </span>
                </div>
                <div class="vehicle-variables">
                    <input type="checkbox" class="vehicle-variable-ac">
                    <input type="checkbox" class="vehicle-variable-hr">
                </div>
                <div class="vehicle-details">
                    <div class="connect-button">
                        <a href="#">
                            Connect&nbsp;
                            <i class="uil uil-step-forward"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        // Get all .filter-input elements
        const filterInputs = document.querySelectorAll('.filter-input');

        // Add an event listener to each .filter-input element
        filterInputs.forEach((filterInput) => {
            filterInput.addEventListener('change', () => {
                // Get the parent .filter element
                const filter = filterInput.parentElement;

                // If the .filter-input element is checked, change the properties of the .filter element
                // Otherwise, reset them
                if (filterInput.checked) {
                    filter.style.backgroundColor = 'var(--delete-edit-color)';
                    filter.style.color = 'var(--title-icon-color)';
                } else {
                    filter.style.backgroundColor = '';
                    filter.style.color = '';
                }
            });
        });
    </script>

    <script>
        function filterVehicles() {
            // Get all checkboxes and vehicle cards
            const acFilterCheckbox = document.getElementById('ac');
            const highRoofFilterCheckbox = document.getElementById('highroof');
            const vehicleCards = document.querySelectorAll('.vehicle-card');

            // Loop through all vehicle cards
            vehicleCards.forEach((vehicleCard) => {
                // Get the vehicle's A/C and High-Roof status
                const hasAc = vehicleCard.querySelector('.vehicle-variable-ac').checked;
                const hasHighRoof = vehicleCard.querySelector('.vehicle-variable-hr').checked;

                // Check if the vehicle matches the selected filters
                const matchesAcFilter = !acFilterCheckbox.checked || (acFilterCheckbox.checked && hasAc);
                const matchesHighRoofFilter = !highRoofFilterCheckbox.checked || (highRoofFilterCheckbox.checked && hasHighRoof);

                // If the vehicle matches all selected filters, show it
                // Otherwise, hide it
                if (matchesAcFilter && matchesHighRoofFilter) {
                    vehicleCard.style.display = 'flex';
                } else {
                    vehicleCard.style.display = 'none';
                }
            });
        }

        // Add event listeners to the filter checkboxes
        document.getElementById('ac').addEventListener('change', filterVehicles);
        document.getElementById('highroof').addEventListener('change', filterVehicles);
    </script>

    <script src="<?php echo URLROOT; ?>/parent/script.js"></script>

    <?php require APPROOT . '/views/inc/footer.php'; ?>