<?php
$this->breadcrumbs=array(
	Yii::t('adm/group','mnu_admin')=>array('admin'),
	$model->group_title=>array('view','id'=>$model->id),
	Yii::t('adm/group','mnu_update_g'),
);

$this->menu=array(
	array('label'=>Yii::t('adm/group','mnu_create'), 'url'=>array('create'),'linkOptions'=>array('class'=>'link-new')),
	array('label'=>Yii::t('adm/group','mnu_view'), 'url'=>array('view', 'id'=>$model->id),'linkOptions'=>array('class'=>'link-view')),
	array('label'=>Yii::t('adm/group','mnu_admin'), 'url'=>array('admin'),'linkOptions'=>array('class'=>'link-manageuser')),
);
?>

<h3><?php echo  Yii::t('adm/group','mnu_update_g');?> <b><?php echo $model->group_title; ?></b></h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>