<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=expready',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => true,
            'transport' => [
               'class' => 'Swift_SmtpTransport',
               'host' => 'smtp.gmail.com',
               'username' => 'shabirullah517@gmail.com',
               'password' => 'izqezbhpdmznswqr',
               'port' => '587',
               'encryption' => 'tls',
           ],
        ]
    ],
];
