<?php

require "../vendor/autoload.php";
include __DIR__ . "/../src/models/Eloquent/Config.php";
include __DIR__ . "/../src/models/Eloquent/DB.php";
//include __DIR__ . "/../src/models/Eloquent/User.php";
//include __DIR__ . "/../src/models/Eloquent/Message.php";
//include __DIR__ . "/../src/controllers/BaseController.php";
//include __DIR__ . "/../src/controllers/FrontController.php";
//include __DIR__ . "/../src/controllers/AdminController.php";

use Illuminate\Database\Capsule\Manager as Capsule;

session_start();



if (!empty($_POST) && strpos($_SERVER['REQUEST_URI'], '/login') !== false) {
    $controller = new \App\Controllers\FrontController();
    $controller->login($_POST);
    return 0;
}

if (!empty($_POST) && strpos($_SERVER['REQUEST_URI'], '/register') !== false) {
    $controller = new \App\Controllers\FrontController();
    $controller->register($_POST);
    return 0;
}

if (!empty($_POST) && strpos($_SERVER['REQUEST_URI'], '/message/add') !== false) {
    $controller = new \App\Controllers\FrontController();
    $controller->add($_POST);
    return 0;
}

if (strpos($_SERVER['REQUEST_URI'], '/message/delete') !== false) {
    $controller = new \App\Controllers\AdminController();
    $controller->delete();
    return 0;
}

if (strpos($_SERVER['REQUEST_URI'], '/message/create') !== false) {
    $controller = new \App\Controllers\AdminController();
    $controller->create($_POST);
    return 0;
}

if (strpos($_SERVER['REQUEST_URI'], '/message') !== false) {
    $controller = new \App\Controllers\FrontController();
    $controller->view();
    return 0;
}

if (strpos($_SERVER['REQUEST_URI'], '/api') !== false) {
    $controller = new \App\Controllers\FrontController();
    $controller->api();
    return 0;
}

if (strpos($_SERVER['REQUEST_URI'], '/logout') !== false) {
    $controller = new \App\Controllers\FrontController();
    $controller->logout();
    return 0;
}

if (strpos($_SERVER['REQUEST_URI'], '/') !== false) {
    $controller = new \App\Controllers\FrontController();
    $controller->index();
    return 0;
}

echo '<pre>';
$capsule = new Capsule;
print_r($capsule->getConnection()->getQueryLog());
