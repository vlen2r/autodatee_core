<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'AutoDatee',
    'basePath' => dirname(__DIR__),
    'name' => 'AutoDatee',
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],


    /**
     * 2021-07-27 Added by Batista for Export in Excel.
     * link: https://www.yiiframework.com/wiki/763/step-by-step-for-how-to-full-export-yii2-grid-to-excel
     */
    
    'modules' => [//add by Scott
        'gridview' => [
            'class' => '\kartik\grid\Module',
        // enter optional module parameters below - only if you need to  
        // use your own export download action or custom translation 
        // message source
        // 'downloadAction' => 'gridview/export/download',
            'downloadAction' => 'export',  //change default download action to your own export action.
        // 'i18n' => []
            ],
        ],
    
    //2021-07-27 - End of the add by Batista


    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'xzy',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                /**
                 * Gestiona los errores, las advertencias y los debug 
                 * y los guarda en un archivo
                 */
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                /**
                 * Gestiona los errores y las advertencias y los debug
                 * y las guarda en una tabla de la base de datos.
                 * Added by Batista Sebastian 2021-08-21.
                 */
                [
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['error', 'warning'],
                ],
                //End of add by Batista Sebastian 2021-08-21
                /**
                 * Gestiona los mensajes de error 
                 * de las categorías cuyos nombres empiecen por yii\db\ 
                 * y los envía por email a las direcciones admin@example.com 
                 * y developer@example.com.
                 * Added by Batista Sebastian 2021-08-21.
                 */
                [
                    'class' => 'yii\log\EmailTarget',
                    'levels' => ['error'],
                    'categories' => ['yii\db\*'],
                    'message' => [
                       'from' => ['log@example.com'],
                       'to' => ['admin@example.com', 'developer@example.com'],
                       'subject' => 'Database errors at example.com',
                    ],
                ],
                //End of add by Batista Sebastian 2021-08-21.
            ],
        ],
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [],
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['201.231.192.171', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
