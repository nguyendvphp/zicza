<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/mystyle.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.alerts.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<div class="container" id="page">

	<div id="header">
		
	</div>
	<div class="mymenu">
		<?php $this->widget('bootstrap.widgets.BootNavbar', array(
		    'fixed'=>false,
		    'brand'=>'Zicza',
		    'brandUrl'=>'#',
		    'collapse'=>true, // requires bootstrap-responsive.css
		    'items'=>array(
		        array(
		            'class'=>'bootstrap.widgets.BootMenu',
		            'items'=>array(
		                array('label'=>'Home', 'url'=>'#', 'active'=>true),
                        array('label'=>Yii::t('adm/admin','mnu_system_config'), 
                          'items'=>array(  
                            array('label'=>Yii::t('adm/admin','mnu_system_setting'), 'url'=> array('/aSystemSetting/admin'),'visible'=>AUserPermission::checkUserPermission('aSystemSetting','del')),
                            array('label'=>Yii::t('adm/admin','mnu_system_user'), 'url'=>array('/aSystemUser/admin'),'visible'=>AUserPermission::checkUserPermission('aSystemUser','del')),
                            array('label'=>Yii::t('adm/admin','clearcache'), 'url'=>array('/aClearCache/index'),'visible'=>AUserPermission::checkUserPermission('aClearCache','del')), 
                            array(
                                'label'=>Yii::t('adm/admin','mnu_system_group'),
                                null,'visible'=>AUserPermission::checkUserPermission('aSystemgroup','view'),
        
                                'items'=>array(
                                    array('label'=>Yii::t('adm/admin','mnu_group'),'url'=>array('/aSystemGroup/admin'),'visible'=>AUserPermission::checkUserPermission('aSystemGroup','del')),
                                    array('label'=>Yii::t('adm/admin','mnu_create_group'),'url'=>array('/aSystemGroup/create'),'visible'=>AUserPermission::checkUserPermission('aSystemGroup','add'))
                                )
                            ),  
                          ), 
                        ),
                        array('label'=>Yii::t('adm/menu','mnu_menu'), 
                          'items'=>array( 
                            array('label'=>Yii::t('adm/menu','mnu_menu_types'), 'url'=> array('/aMenuTypes/admin'),'visible'=>AUserPermission::checkUserPermission('aNewsCategories','del')),
                            array('label'=>Yii::t('adm/menu','mnu_listmenu'), 'url'=>array('/aMenu/admin'),'visible'=>AUserPermission::checkUserPermission('aNews','del')),
                            //array('label'=>Yii::t('adm/cp','mnu_banner'), 'url'=>array('/aContentProvider/admin'),'visible'=>AUserPermission::checkUserPermission('aContentProvider','del')),                   
                          ), 
                        ),
                        array('label'=>Yii::t('adm/news','mnu_info'), 
                          'items'=>array( 
                            array('label'=>Yii::t('adm/news','mnu_cate_news'), 'url'=> array('/aNewsCategories/admin'),'visible'=>AUserPermission::checkUserPermission('aNewsCategories','del')),
                            array('label'=>Yii::t('adm/news','mnu_news'), 'url'=>array('/aNews/admin'),'visible'=>AUserPermission::checkUserPermission('aNews','del')),
                            //array('label'=>Yii::t('adm/cp','mnu_banner'), 'url'=>array('/aContentProvider/admin'),'visible'=>AUserPermission::checkUserPermission('aContentProvider','del')),                   
                          ), 
                        ),
                        array('label'=>Yii::t('adm/useritem','Quản lý Shop'), 
                          'items'=>array( 
                            array('label'=>Yii::t('adm/gallery','Danh sách Shop'), 'url'=> array('/aUserItem/admin'),'visible'=>AUserPermission::checkUserPermission('aUserItem','del')),
                            //array('label'=>Yii::t('adm/cp','mnu_banner'), 'url'=>array('/aContentProvider/admin'),'visible'=>AUserPermission::checkUserPermission('aContentProvider','del')),                   
                          ), 
                        ),
                        array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/aSite/logout'), 'visible'=>!Yii::app()->user->isGuest),
		            ),
		        ),
		        '<form class="navbar-search pull-left" action=""><input type="text" class="search-query span2" placeholder="Search"></form>',
		    ),
		)); ?>
	</div>
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.BootBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
	<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by Nguyendv.<br/>
		All Rights Reserved.<br/>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
