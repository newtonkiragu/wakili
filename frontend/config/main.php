<?php

$params = array_merge(
        require __DIR__ . '/../../common/config/params.php', require __DIR__ . '/../../common/config/params-local.php', require __DIR__ . '/params.php', require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'name' => 'Wakili 101',
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'mailer' => [
                'sender' => ['no-reply@elawyer.com' => 'Michael Mutinda'],
                'welcomeSubject' => 'Welcome ',
                'confirmationSubject' => 'Confirmation ',
                'reconfirmationSubject' => 'Email change ',
                'recoverySubject' => 'Recovery ',
            ],
            'enableUnconfirmedLogin' => false,
            'cost' => 13,
            'confirmWithin' => 86400,
            'enablePasswordRecovery' => true,
            'urlPrefix' => 'auth',
            'admins' => [''],
            'recoverWithin' => 21600,
            'rememberFor' => 1209600,
            'adminPermission' => 'administrator',
            'enableRegistration' => true,
            'enableGeneratingPassword' => false,
            'enableConfirmation' => true,
            'enableAccountDelete' => false,
        ],
       
    ],
    'components' => [
        'assetManager' => [
            'bundles' => [

                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                ],
                'yii\web\JqueryAsset' => [
                    'js' => []
                ],
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'class' => 'common\components\Request',
            'web' => '/frontend/web'
        ],
        // 'user' => [
        //     'identityClass' => 'common\models\User',
        //     'enableAutoLogin' => true,
        //     'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        // ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        //'enableStrictParsing'=>true,
        ],
    ],
    'params' => $params,
];
