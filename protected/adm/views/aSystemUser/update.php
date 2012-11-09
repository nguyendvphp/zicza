<?php
$this->breadcrumbs=array(
	Yii::t('adm/app','manage_sysuser')=>array('admin'),
	$model->username=>array('view','id'=>$model->id),
	Yii::t('adm/app','update_sysuser'),
);

$this->menu=array(
	array('label'=>Yii::t('adm/app','create_sysuser'), 'url'=>array('create'),'linkOptions'=>array('class'=>'link-new')),
	array('label'=>Yii::t('adm/app','view_sysuser'), 'url'=>array('view', 'id'=>$model->id),'linkOptions'=>array('class'=>'link-view')),
	array('label'=>Yii::t('adm/app','icon_sysuser'), 'url'=>array('admin'),'linkOptions'=>array('class'=>'link-manageuser')),
);
?>

<h3><?php echo Yii::t('adm/app','update_sysuser'); ?> : <?php echo $model->username; ?></h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>