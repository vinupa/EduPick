<?php
// Load Config
require_once 'config/config.php';

// Load PHPMailer
require 'plugins/PHPMailer/src/Exception.php';
require 'plugins/PHPMailer/src/PHPMailer.php';
require 'plugins/PHPMailer/src/SMTP.php';

// Load Helpers
require_once 'helpers/url_helper.php';
require_once 'helpers/session_helpers.php';
require_once 'helpers/mail.php';

// Load Libraries
// require_once 'libraries/Core.php';
// require_once 'libraries/Controller.php';
// require_once 'libraries/Database.php';

// Autoload Core Libraries
spl_autoload_register(function($className){
    require_once 'libraries/' . $className . '.php';
});