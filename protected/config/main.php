<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Zicza - Lời khuyên chân thành cho các bạn',
    'theme'=>'default',
	// preloading 'log' component
	'preload'=>array('log','bootstrap',),
    'sourceLanguage' => 'en',
    'language'=>'vi',//default languages\
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'ext.widgets.portlet.XPortlet',
        'ext.mbmenu.*',
        'ext.locaConfigXML.XmlMenu',
	),

	'modules'=>array(
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'returnUrl' => 'aSite/login',
			'loginUrl' => 'aSite/login'
		),
        'bootstrap'=>array(
		        'class'=>'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
        ),
        
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=zicza;port=3306',
            //'connectionString' => 'mysql:host=10.2.0.107;dbname=beta_gamestore;port=3306',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix' => 'tbl_',
			'enableProfiling' => true,
			'enableParamLogging' => true,
			'schemaCachingDuration'=>'3600',
		),
		'cache' => array(
            'class' => 'system.caching.CFileCache',
        ),
		
		'log'=>array(
           'class'=>'CLogRouter',

			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),

          ),
          
          
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);