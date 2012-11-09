<?php
$this->breadcrumbs=array(
	Yii::t('adm/app','manage_sysuser')=>array('admin'),
	$model->username,
);

$this->menu=array(
	array('label'=>Yii::t('adm/app','create_sysuser'), 'url'=>array('create'),'linkOptions'=>array('class'=>'link-new')),
	array('label'=>Yii::t('adm/app','update_sysuser'), 'url'=>array('update', 'id'=>$model->id),'linkOptions'=>array('class'=>'link-edit')),
	array('label'=>Yii::t('adm/app','delete_sysuser'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('adm/app','confirm'),'class'=>'link-delete')),
	array('label'=>Yii::t('adm/app','icon_sysuser'), 'url'=>array('admin'),'linkOptions'=>array('class'=>'link-manageuser')),
);

?>


<h3><?php echo Yii::t('adm/app','view_sysuser');?> - <?php echo $model->username; ?></h3>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'username',
        'email',
		array(
			'name'=>'status',
            'value'=>($model->status == 1) ? Yii::t('adm/app','Enable') : Yii::t('adm/app','disable'),		
		),
        'phonenumber',
		'created_date',
		'lastest_login',
		'ip',
		'groups.group_title',
	),
)); ?>

<?php echo $this->renderPartial('_permission', array('arrayDataProvider'=>$arrayDataProvider,'id'=>$model->id)); ?>