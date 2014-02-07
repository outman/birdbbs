<?php
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'不想说',

    // preloading 'log' component
    'preload'=>array('log'),

    // application components
    'components'=>array(
        'db'=>array(
            'connectionString' => 'mysql:host=127.0.0.1;dbname=birdbbs',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'admin',
            'charset' => 'utf8',
            'tablePrefix' => 'bbs_',
            'schemaCachingDuration' => 3600,
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
);