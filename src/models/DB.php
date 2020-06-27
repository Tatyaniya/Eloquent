<?php

namespace App\Models;

use Illuminate\Database\Capsule\Manager as Capsule;

class DB
{
    public function connect()
    {
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

        $capsule->bootEloquent();
    }
}

//$db = new DB();
//var_dump($db);