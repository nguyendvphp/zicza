<?php
$this->breadcrumbs=array(
	Yii::t('adm/admin','Quản lý Cache'),
);
 
$this->pageTitle=Yii::t('adm/admin','Quản lý Cache của hệ thống');
$this->pageHint=Yii::t('adm/admin','Bạn có thể Clear Cache & Assets trong Admin và Web'); 
?>
<?php $this->widget('CachingClearWidget',array()); 
?>