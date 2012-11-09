<?php
$this->breadcrumbs=array(
	Yii::t('adm/app','manage_sysuser')=>array('admin'),
	Yii::t('adm/app','create_sysuser'),
);

$this->menu=array(
	array('label'=>Yii::t('adm/app','icon_sysuser'), 'url'=>array('admin'),'linkOptions'=>array('class'=>'link-manageuser')),
);
?>

<h3><?php echo Yii::t('adm/app','create_sysuser')?></h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>