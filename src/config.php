<?php
// Error reporting for development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define constants
define('BASE_PATH', dirname(__DIR__));
define('PUBLIC_PATH', BASE_PATH . '/public');
define('ENVIRONMENT', 'development'); // Change to 'production' for production
