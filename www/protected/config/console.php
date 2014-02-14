<?php
$config = __DIR__ . '/config.php';
if (!file_exists($config)) {
    header("Location: install.php");
    exit();
}
require $config;

return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'BIRDBBS',
    'preload'=>array('log'),
    'components'=>array(
        'db'=>$CONF['db'],
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