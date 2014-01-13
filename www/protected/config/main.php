<?php
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'BirdBBS',
    'theme' => 'classic',
    'language' => 'zh_cn',
    'preload'=>array('log'),
    'defaultController' => 'home',
    
    'import'=>array(
        'application.models.*',
        'application.components.*',
    ),

    'modules'=>array(
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'admin',
            'ipFilters'=>array('127.0.0.1','::1'),
        ),
        'admin',
    ),

    // application components
    'components'=>array(
        'user'=>array(
            // enable cookie-based authentication
            'allowAutoLogin'=>true,
        ),
        'urlManager'=>array(
            'urlFormat'=>'path',
            'rules'=>array(
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ),
            'showScriptName' => false,
        ),
        'db'=>array(
            'connectionString' => 'mysql:host=127.0.0.1;dbname=birdbbs',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'admin',
            'charset' => 'utf8',
            'tablePrefix' => 'bbs_',
        ),
        'errorHandler'=>array(
            'errorAction'=>'error/index',
        ),
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                ),
            ),
        ),
    ),
    'params'=>array(
        'adminEmail'=>'webmaster@example.com',
    ),
);