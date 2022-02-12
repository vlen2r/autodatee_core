<?php

return [
    'class' => 'yii\db\Connection',

    'attributes' => [
        // utilizar un tiempo de espera de conexión más pequeña
        PDO::ATTR_TIMEOUT => 120,
    ],

//ambiente de prueba 2020 - CPanel autodateetest.siseservicios.com/web
//    'dsn' => 'mysql:host=localhost;dbname=siseserv_autodateetest',
//    'username' => 'siseserv_autodatee',
//    'password' => 'sise.2016',
//    'charset' => 'utf8',

//ambiente de producción 2021 - AWS IP:888 / IP:999
    'dsn' => 'mysql:host=mysql_test;dbname=siseserv_autodatee',
    'username' => 'docker',
    'password' => 'docker',
    'charset' => 'utf8',

//ambiente de desarrollo 2021 - VirtualBox
//    'dsn' => 'mysql:host=mysql;dbname=siseserv_autodatee',
//    'username' => 'root',
//    'password' => 'docker',
//    'charset' => 'utf8',
	
//ambiente de desarrollo 2020 - ????
//    'dsn' => 'mysql:host=mysql;dbname=databas',
//    'username' => 'root',
//    'password' => 'Sise.2016',
//    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
