<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'api\controllers',
    'components' => [
        'request' => [
            //'csrfParam' => '_csrf-api',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-api', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the api
            'name' => 'advanced-api',
            'cookieParams' => [
                'path' => '/api',
            ],
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
            //'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'user'],
                [
                    'class'         => 'yii\rest\UrlRule',
                    'controller'    => 'collection',
                    'extraPatterns' => [
                        'GET findbyid/{collectionID}'   => 'findbyid',
                        'GET byuser/{userID}'           => 'byuser',
                        'PUT updatedata/{collectionID}' => 'updatedata',
                    ],
                    'tokens'        => [
                        '{collectionID}'    => '<collectionID:\\d[\\d,]*>',
                        '{userID}'          => '<userID:\\d[\\d,]*>'
                    ]
                ],
                [
                    'class'         => 'yii\rest\UrlRule',
                    'controller'    => 'image',
                    'extraPatterns' => [
                        'GET findbyid/{imageID}'            => 'findbyid',
                        'GET bycollection/{collectionID}'   => 'bycollection',
                        'PUT updatedata/{imageID}'          => 'updatedata',
                    ],
                    'tokens'        => [
                        '{collectionID}'    => '<collectionID:\\d[\\d,]*>',
                        '{imageID}'         => '<imageID:\\d[\\d,]*>'
                    ]
                ],
            ],
        ],
    ],
    'params' => $params,
];
