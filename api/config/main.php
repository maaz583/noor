<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-api',
    'name' => 'yii2 advanced',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'class' => 'api\versions\v1\RestModule'
        ],
    ],
    'components' => [
        'request' => [
            'class' => '\yii\web\Request',
            'enableCookieValidation' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'response' => [
            'format' => yii\web\Response::FORMAT_JSON,
            'charset' => 'UTF-8',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-api-advanced', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the api
            'name' => 'advanced-api',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => true,
            //'enableSession' => false,
            //'loginUrl' => null,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => ['v1/user'], 'extraPatterns' => [
                    'POST login' => 'login',
                    'OPTIONS login' => 'options',

                    'POST signup' => 'usersignup',
                    'OPTIONS signup' => 'options',

                    'POST organization' => 'organization',
                    'OPTIONS organization' => 'options',

                    'POST adduserrole' => 'adduserrole',
                    'OPTIONS adduserrole' => 'options',

                    'POST addacademic' => 'addacademic',
                    'OPTIONS addacademic' => 'options',

                    'POST addstudent' => 'addstudent',
                    'OPTIONS addstudent' => 'options',

                    'POST addprogram' => 'addprogram',
                    'OPTIONS addprogram' => 'options',

                    'POST addinstructor' => 'addinstructor',
                    'OPTIONS addinstructor' => 'options',
                    ]
                ],
            ],
        ],
        
    ],
    'params' => $params,
];
