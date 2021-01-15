<?php

return [
    'class' => 'yii\db\Connection',


//ambiente de test CPanel autodateetest.siseservicios.com/web
    'dsn' => 'mysql:host=localhost;dbname=siseserv_autodateetest',
    'username' => 'siseserv_autodatee',
    'password' => 'sise.2016',
    'charset' => 'utf8',

//ambiente de desarrollo 2021
//    'dsn' => 'mysql:host=mysql;dbname=siseserv_autodatee',
//    'username' => 'docker',
//    'password' => 'docker',
//    'charset' => 'utf8',
	
//ambiente de desarrollo 2020
//    'dsn' => 'mysql:host=mysql;dbname=databas',
//    'username' => 'root',
//    'password' => 'Sise.2016',
//    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
