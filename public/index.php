<?php
require_once '../src/config.php';

$route = $_SERVER['REQUEST_URI'] ?? '/';
$route = trim($route, '/');

// Basic header
include_once '../src/templates/header.php';

// Basic routing
switch ($route) {
    case '':
    case 'home':
        include_once '../src/pages/home.php';
        break;
    case 'about':
        include_once '../src/pages/about.php';
        break;
    default:
        include_once '../src/pages/404.php';
        break;
}

// Basic footer
include_once '../src/templates/footer.php'; 