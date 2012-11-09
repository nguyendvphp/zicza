<?php
$this->breadcrumbs=array(
	Yii::t('adm/news','manage_news')=>array('admin'),
	Yii::t('adm/news','create_news'),
);

$this->menu=array(
	array('label'=>Yii::t('adm/news','manage_news'), 'url'=>array('admin'),'linkOptions'=>array('class'=>'link-manageuser')),
);
?>

<h3><?php echo Yii::t('adm/news','create_news');?></h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>