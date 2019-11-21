<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=ziggyjobs',
            'username' => 'ziggyjobs',
            'password' => 'ziggyjobs',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'email-smtp.us-west-2.amazonaws.com',
                'username' => 'AKIAJEHAKJES6AXXWN6Q',
                'password' => 'Anzi06PYR4Clh4gEDbzZo30cfYbfDC7tTX9GvPZ+RFix',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
    ],
];
