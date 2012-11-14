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
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/zicza.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/Paging.css" />
    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/global.js"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
    
</head>

<body>
    <div id="wrapper">
        <div id="header">
            <div id="logo">
                <a href=""><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/logo.png" alt="logo zicza" /></a>
            </div>
            
            <div id="login">
                <span>Nếu muốn người tiêu dùng binh luận và chia sẻ về sản phẩm:</span>
                <?php if(!isset(Yii::app()->session['email_fb'])): ?>
                    <a href="<?php echo Yii::app()->createUrl('wUserItem/createshop');?>"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/createshop.png" /></a>
                <?php else :?>
                    <a href=""><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/fb-login.png" /></a>
                <?php endif;?>
                
            </div>
            <div class="clear"></div>
        </div>
        <div id="primary">
            <div id="sidebar">
                <div>
                    <span class="slogan">"Web bình luận mua sắm"</span> giúp bạn biết cái gì nên mua và không nên mua trên Internet.
                </div>
            </div>
            <div id="maincontent">
                <?php echo $content;?>
                
                <!--<div class="FrameListContents Radius">
                    <div class="MenuCate">
                        <a href="#" class="Active">Danh sách shop trên Zicza</a>
                    </div>
                    <div id="ListShop">
                        
                        
                    </div>
                    
                </div>-->
            </div>
            <div class="clear"></div>
        </div>
        <div id="footer">
            <div id="mainmenu">
                <?php $this->widget('zii.widgets.CMenu',array(
        			'items'=>array(
        				//array('label'=>'Home', 'url'=>array('/site/index')),
        				array('label'=>Yii::t('web/home','homepage'), 'url'=>array('Site/index')),
                        array('label'=>Yii::t('web/home','Giới thiệu'), 'url'=>array('/site/page', 'view'=>'about')),
                        array('label'=>Yii::t('web/home','contact'), 'url'=>array('/site/contact')),
        			 ),
   		      )); ?>
            </div>
        </div>
    </div><!-- wrapper -->
</body>
</html>