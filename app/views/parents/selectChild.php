<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/parent/style.css" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/parent/selectChildStyle.css" />
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

            <div class="message">
                <p class="text">Select a child to find a vehicle for,</p>
            </div>
        </div>

        <form action="<?php echo URLROOT; ?>/parents/selectChild" method="POST">

            <div class="child-cards">

                <?php foreach ($data['children'] as $child): ?>
                    <label class="child-card">
                        <input type="radio" name="child" value="<?php echo $child->childID; ?>" class="child-radio" <?php
                           if (isset($_SESSION['childID'])) {
                               if ($_SESSION['childID'] == $child->childID) {
                                   echo 'checked';
                               }
                           }
                           ?>>
                        <div class="child-details">
                            <div class="child-details-left">
                                <span class="child-name">
                                    <?php echo $child->firstName; ?>
                                    <?php echo $child->lastName; ?>
                                </span>
                            </div>
                            <div class="child-details-right">
                                <span class="child-school">
                                    <?php echo $child->schoolName; ?>
                                </span>
                                <span class="child-grade">Grade
                                    <?php echo $child->grade; ?>
                                </span>
                            </div>
                        </div>
                    </label>
                <?php endforeach; ?>

            </div>

            <div class="confirm-button">
                <!-- <input type="submit" value="Confirm"> -->
                <button type="submit" id="the-confirm-button" disabled="disabled">
                    <span>Confirm</span>
                    <i class="uil uil-step-forward"></i>
                </button>
            </div>

        </form>
    </div>
    </section>

    <script src="<?php echo URLROOT; ?>/parent/script.js"></script>

    <script>

        // Get the confirm button and all radio buttons
        const confirmButton = document.getElementById('the-confirm-button');
        const childRadios = document.querySelectorAll('.child-radio');

        // Function to check if any radio button is checked
        function checkRadios() {
            let checked = Array.from(childRadios).some(radio => radio.checked);

            // If a radio button is checked, show and enable the confirm button
            // Otherwise, hide and disable it
            if (checked) {
                confirmButton.style.display = 'block';
                confirmButton.disabled = false;
            } else {
                confirmButton.style.display = 'none';
                confirmButton.disabled = true;
            }
        }

        // Call checkRadios when the page is loaded
        window.onload = checkRadios;

        // Add an event listener to each radio button
        childRadios.forEach((radio) => {
            radio.addEventListener('change', checkRadios);
        });
    </script>

    <?php require APPROOT . '/views/inc/footer.php'; ?>