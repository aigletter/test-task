<?php

//$params = require __DIR__ . '/params.php';
//$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => getenv('DB_DSN'),
            'username' => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD'),
            'charset' => getenv('DB_CHARSET'),
        ],
        'clickhouse' => [
            //'class' => 'bashkarev\clickhouse\Connection',
            'class' => \app\components\bashkarev\clickhouse\Connection::class,
            'dsn' => getenv('DB_DSN'),
            'username' => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD'),
        ],
    ],
    /*'controllerMap' => [
        'clickhouse-migrate' => 'bashkarev\clickhouse\console\controllers\MigrateController'
    ],*/
    'params' => [
        'adminEmail' => getenv('MAIL_ADMIN_EMAIL'),
        'senderEmail' => getenv('MAIL_ADMIN_EMAIL'),
        'senderName' => getenv('MAIL_SENDER_NAME'),
    ],
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
    'modules' => [
        'logging' => [
            'class' => \aigletter\logging\Module::class,
            'db' => getenv('DB_CONNECTION') ?: 'db',
            // ... другие настройки модуля ...
            'params' => [
                //'defaultLogFile' => '/var/log/nginx/access.log',
                //'logFormat' => '%h %l %u %t "%r" %>s %O "%{Referer}i" \"%{User-Agent}i"',
                'batchSize' => 5,
            ],
            'controllerMap' => [
                'migrate' => [
                    'class' => getenv('DB_CONNECTION') === 'db'
                        ? \aigletter\logging\commands\MigrateController::class
                        : \bashkarev\clickhouse\console\controllers\MigrateController::class,
                    'db' => getenv('DB_CONNECTION') ?: 'db',
                    //'class' =>\bashkarev\clickhouse\console\controllers\MigrateController::class,
                    'migrationNamespaces' => [
                        //'app\migrations',
                        'aigletter\logging\migrations',
                    ],
                    //'migrationPath' => null, // allows to disable not namespaced migration completely
                ],
            ],
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
    // configuration adjustments for 'dev' environment
    // requires version `2.1.21` of yii2-debug module
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
