<?php

$web=dirname(dirname(__FILE__));
$base=dirname($web);
Yii::setPathOfAlias('web', $web);

$baseArray=require($base.'/config/main.php');

// This is the main Web application backend configuration. Any writable
// CWebApplication properties can be configured here.
$backendArray=array(
    'basePath' => $base,
    'name'=>'Zicza - Lời khuyên tốt nhất dành cho bạn',
    'preload'=>array(
		'log',
		//'foundation',
		//'bootstrap',
	),
    'theme'=>'default',
    'controllerPath' => $web.'/controllers',
    'viewPath' => $web.'/views',
    'runtimePath' => $web.'/runtime',
	'defaultController'=>'Site',
    // autoloading model and component classes
    'import'=>array(
        'web.models.*',
        'web.components.*',
        'application.models.*',
        'application.components.*',
        'application.extensions.*',
        'ext.widgets.portlet.XPortlet',
        'ext.esearch.*',
        'application.extensions.loadConfigXML.*',
       
    ),
    

    // main is the default layout
    //'layout'=>'main',
    // alternate layoutPath
    //'layoutPath'=>dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'layouts'.DIRECTORY_SEPARATOR,

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName'] and MParams class
    'params'=>require(dirname(__FILE__).'/params.php'),
    'modules'=>array(
		/*'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'boot',
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths'=>array('bootstrap.gii'),
		),*/
	),
    // application components
    'components'=>array(
        'bootstrap'=>array(
			'class'=>'ext.bootstrap.components.Bootstrap',
			'responsiveCss'=>true,
		),
		'errorHandler'=>array(
			'errorAction'=>'site/error',
		),
    /*
    	'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
			'showScriptName' => false,
		),
		*/
    ),
);

if(!function_exists('w3_array_union_recursive'))
{
    /**
     * This function does similar work to $array1+$array2,
     * except that this union is applied recursively.
     * @param array $array1 - more important array
     * @param array $array2 - values of this array get overwritten
     * @return array
     */
    function w3_array_union_recursive($array1,$array2)
    {
        $retval=$array1+$array2;
        foreach($array1 as $key=>$value)
        {
            if(isset($array1[$key]) && isset($array2[$key]) && is_array($array1[$key]) && is_array($array2[$key]))
                $retval[$key]=w3_array_union_recursive($array1[$key],$array2[$key]);
        }
        return $retval;
    }
}
//echo '<pre>';
// var_dump(w3_array_union_recursive($backendArray,$baseArray));
 //echo '</pre>';
 return w3_array_union_recursive($backendArray,$baseArray);
?>