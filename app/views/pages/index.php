<?php
    if(isset($_SESSION['user_id'])){
        if($_SESSION['user_type'] == 'parent'){
            redirect('parents/index');
        } elseif($_SESSION['user_type'] == 'owner'){
            redirect('owners/index');
        } elseif($_SESSION['user_type'] == 'driver'){
            redirect('drivers/index');
        }
    } else {
        redirect('users/index');
    }
?>
