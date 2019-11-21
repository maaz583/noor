<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=smsami-new.cuq6jftikyqx.us-west-2.rds.amazonaws.com;dbname=ziggyjobs',
            'username' => 'ziggyjobs',
            'password' => 'Pakistan1234',
            'charset' => 'utf8',
        ],

        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'enableSwiftMailerLogging' => true,
            'useFileTransport' => false,
             
        ],
    ],
];
