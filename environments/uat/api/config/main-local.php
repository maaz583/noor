<?php

return [
	'components' => [
		'request' => [
			// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
			'cookieValidationKey' => '',
		],
		'log' => [
			'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets' => [
				[
					'class' => 'yii\log\FileTarget',
					'levels' => ['error', 'warning'],
					'except' => [
						'yii\web\HttpException:401',
						'yii\web\HttpException:403',
						'yii\web\HttpException:404',
						'yii\web\HttpException:406',
						'yii\web\HttpException:409',
					],
				],
			],
		],
	],
];
