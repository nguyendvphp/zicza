<?php
$this->breadcrumbs=array(
	Yii::t('adm/app','mnu_system_group')=>array('index'),
	Yii::t('adm/group','mnu_create'),
);

$this->menu=array(
	array('label'=>Yii::t('adm/app','mnu_system_group'), 'url'=>array('admin'),'linkOptions'=>array('class'=>'link-new')),
);
?>

<h3><?php echo Yii::t('adm/group','mnu_create');?></h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>