<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Cron',
    'preload'=>array('log'),
    'import'=>array(
            'application.components.*',
            'application.models.*',
    ),
    // application components
    'components'=>array(
        'db'=>array(
                'connectionString' => 'mysql:host=localhost;dbname=MTVbetting',
                'emulatePrepare' => true,
                'username' => 'root',
                'password' => 'LMWadmin12345',
                'charset' => 'utf8',
                'enableProfiling' => true,
        ),
        'log'=>array(
                'class'=>'CLogRouter',
                'routes'=>array(
                        array(
                                'class'=>'CFileLogRoute',
                                'logFile'=>'cron.log',
                                'levels'=>'error, warning',
                        ),
                        array(
                                'class'=>'CFileLogRoute',
                                'logFile'=>'cron_trace.log',
                                'levels'=>'trace',
                        ),
                ),
        ),
        'functions'=>array(
                'class'=>'application.extensions.functions.Functions',
        ),
    ),
);