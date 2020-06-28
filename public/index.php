<?php

require "../vendor/autoload.php";
include __DIR__ . "/../src/models/Eloquent/Config.php";

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Models\Eloquent\User as User;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => DB_HOST,
    'database'  => DB_NAME,
    'username'  => DB_USER,
    'password'  => DB_PASSWORD,
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();

$capsule->bootEloquent();

$users = User::all();
foreach($users as $user) {
    echo $user->name . '<br>';
}

$user = new User();
$us = $user->get('tatyana@gmail.com');
$id = $user->get('tatyana@gmail.com');
var_dump($id->password);

include __DIR__ . "/../src/models/Eloquent/DB.php";

session_start();



echo '<pre>';
$capsule = new Capsule;
print_r($capsule->getConnection()->getQueryLog());

echo '<pre>';

//
//
// function getPasswordHash($password)
// {
//     return $passwordHash = sha1($password . '.sdfifao38vj,');
// }
//
// $ps = getPasswordHash(55555);
// //var_dump($ps);
//
//
//
// $password = $user->getPasswordHash(55555);
// $email = $user->get('tatyana@gmail.com')->id;
//
//         //var_dump($password);
//         var_dump($email);
//
// function get($email)
// {
//     return User::where('email', '=', $email)->first();
// }



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
