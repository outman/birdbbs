<?php
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'不想说',
    'theme' => 'classic',
    'language' => 'zh_cn',
    'preload'=>array('log'),
    'defaultController' => 'home',
    
    'import'=>array(
        'application.models.*',
        'application.components.*',
        'application.components.widget.*',
        'ext.mail.*',
    ),

    'modules'=>array(
        'admin',
    ),

    // application components
    'components'=>array(
        
        'request' => array(
            'enableCsrfValidation'=>true,
            'enableCookieValidation'=>true,
            'csrfTokenName' => 'BIRDBBS_CSRF_TOKEN',
        ),

        'user'=>array(
            'allowAutoLogin'=>true,
            'loginUrl' => array('home/login'),
        ),
        // url rewirte
        // 'urlManager'=>array(
        //     'urlFormat'=>'path',
        //     'rules'=>array(
        //         // '<controller:\w+>/<id:\d+>'=>'<controller>/view',
        //         '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
        //         '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
        //     ),
        //     'showScriptName' => false,
        // ),
        'db'=>array(
            'connectionString' => 'mysql:host=127.0.0.1;dbname=birdbbs',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'admin',
            'charset' => 'utf8',
            'tablePrefix' => 'bbs_',
            'schemaCachingDuration' => 3600,
        ),
        'cache' => array(
            'class' => 'system.caching.CFileCache',
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
    'params' => require(__DIR__ . '/params.php'),
);