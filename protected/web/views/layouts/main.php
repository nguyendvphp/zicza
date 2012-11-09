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
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div id="wrapper">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
        <div id="login-search">
            <div class="login">
                <?php $this->widget('application.extensions.login.XLoginPortlet',array(
                     'visible'=>Yii::app()->user->isGuest,
                ));
                ?>
            </div>
            <div class="search-cart">
                <div class="search-form">
                
                </div>
                <div class="cart">
                
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="clear"></div>
        <div class="game_advertise">
            
        </div>
	</div><!-- header -->
    <div id="maincontent">
	       <?php echo $content; ?>
    </div>
	<div id="footer">
		<div class="box_footer">
            <h3><?php echo Yii::t('web/home','site_map');?></h3>
            <ul>
                <li><a><?php echo Yii::t('web/home','homepage');?></a></li>
                <li><a><?php echo Yii::t('web/home','news');?></a></li>
                <li><a><?php echo Yii::t('web/home','mobile_games');?></a></li>
                <li><a><?php echo Yii::t('web/home','productor');?></a></li>
                <li><a><?php echo Yii::t('web/home','forum');?></a></li>
                <li><a><?php echo Yii::t('web/home','introduce');?></a></li>
                <li><a><?php echo Yii::t('web/home','contact');?></a></li>
            </ul>
        </div>
        <div class="box_footer">
            <h3><?php echo Yii::t('web/home','list_games');?></h3>
            <ul>
                <li><a><?php echo Yii::t('web/home','homepage');?></a></li>
                <li><a><?php echo Yii::t('web/home','news');?></a></li>
                <li><a><?php echo Yii::t('web/home','mobile_games');?></a></li>
                <li><a><?php echo Yii::t('web/home','productor');?></a></li>
                <li><a><?php echo Yii::t('web/home','forum');?></a></li>
                <li><a><?php echo Yii::t('web/home','introduce');?></a></li>
                <li><a><?php echo Yii::t('web/home','contact');?></a></li>
            </ul>
        </div>
        <div class="box_footer">
            <div class="followus">
                <h3><?php echo Yii::t('web/home','followus');?></h3>
                
            </div>
            <div class="contactus">
                <h3><?php echo Yii::t('web/home','contactus');?></h3>
                <p>
                    Cty cá»• pháº§n truyá»�n thÃ´ng Centech <br />

                    PhÃ²ng 1503, tÃ²a nhÃ  HITTC, 185 Giáº£ng VÃµ, Ä�á»‘ng Ä�a, HÃ  Ná»™i, Viá»‡t Nam<br />
                    
                    Ä�iá»‡n thoai: (+84).4.35122042<br />
                    
                    Fax: (+84).4.35122250
                </p>
            </div>
        </div>
	</div><!-- footer -->

</div><!-- wrapper -->

</body>
</html>