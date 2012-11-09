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
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/jquery-ui.css" />
    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/global.js"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
    
</head>

<body>
    <div id="wrapper">
        <div id="headersub">
            <div id="slogan">
                <p>Cái loa mua sắm Zicza.com</p>
                <p>Cho biết cửa hàng nào <span class="like">Nên Mua</span> hay <span class="dislike">Không Nên Mua</span> trên Internet.</p>
            </div>
            <div id="company">
                <a href="<?php echo Yii::app()->createUrl('Site/index');?>"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/company.png" border="0" /></a>
            </div>
            <div class="clear"></div>
        </div>
        <div id="primary">
            <?php echo $content;?>
        </div>
        <div id="footer">
            <div class="info">
                Công ty tư vấn mua hàng ZicZa.<br />
                Địa chỉ: abc
            </div>
        </div>
    </div><!-- wrapper -->
</body>
</html>