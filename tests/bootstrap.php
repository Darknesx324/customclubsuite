<?php
/**
 * Bootstrap file for PHPUnit tests
 */

// Define constants needed for the application
if (!defined('base_url')) {
    define('base_url', 'http://localhost/Custom_Club_Suite/');
}

if (!defined('base_app')) {
    define('base_app', str_replace('\\', '/', __DIR__ . '/../') . '/');
}

if (!defined('dev_data')) {
    define('dev_data', array('id' => '-1', 'firstname' => 'Admin', 'lastname' => '', 'username' => 'admin', 'password' => '5da283a2d990e8d8512cf967df5bc0d0', 'last_login' => '', 'date_updated' => '', 'date_added' => ''));
}

if (!defined('DB_SERVER')) {
    define('DB_SERVER', 'localhost');
}

if (!defined('DB_USERNAME')) {
    define('DB_USERNAME', 'root');
}

if (!defined('DB_PASSWORD')) {
    define('DB_PASSWORD', '');
}

if (!defined('DB_NAME')) {
    define('DB_NAME', 'car_service_center_db');
}

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include necessary files
require_once __DIR__ . '/../initialize.php';
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../classes/DBConnection.php';
require_once __DIR__ . '/../classes/SystemSettings.php';
