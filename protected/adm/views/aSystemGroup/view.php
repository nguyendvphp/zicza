<?php
$this->breadcrumbs=array(
	Yii::t('adm/app','mnu_system_group')=>array('admin'),
	$model->group_title,
);

$this->menu=array(
    array('label'=>Yii::t('adm/group','mnu_create'), 'url'=>array('create'),'linkOptions'=>array('class'=>'link-new')),
	array('label'=>Yii::t('adm/group','mnu_update'), 'url'=>array('update', 'id'=>$model->id),'linkOptions'=>array('class'=>'link-edit')),
	array('label'=>Yii::t('adm/group','mnu_delete'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('app','confirm'),'class'=>'link-delete')),
	array('label'=>Yii::t('adm/group','mnu_admin'), 'url'=>array('admin'),'linkOptions'=>array('class'=>'link-manageuser')),
);
?>

<h3> <?php echo Yii::t('adm/group','lbl_group_title').': '.$model->group_title; ?></h3>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'group_title',
		'group_desc',
		array(
			'name' => 'status',
			'value' => CHtml::encode(ASystemGroup::getStatusText($model->status)),
		),
		'created_date',
	),
)); ?>
<div class="group-admin-view"><?php echo Yii::t('adm/group','lbl_user_in_group'); ?></div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'system-user-grid',
	'dataProvider'=>$bSystemUserDataProvider,
	'columns'=>array(
        array(
            "name"=>'username',
            "type"=>'html',
            "value"=>'Chtml::link("<b>".$data->username."</b>",array("/aSystemuser/view&id=$data->id"))',
        ),
        'fullname',
         array(
			'name'=>'status',
            'type'=>'raw',
            'value'=>'($data->status == 0) ? "<span id=\"active_status".$data->id."\"><img onclick=\"changeStatus(\'".$data->id."\',0);\" class=\"active_status\" title=\"'.Yii::t('app','status_inactive').'\" src=\"'.Yii::app()->getRequest()->baseUrl.'/images/icons/publish_x.png\" /></span>": "<span id=\"active_status".$data->id."\"><img onclick=\"changeStatus(\'".$data->id."\',1);\" class=\"active_status\" title=\"'.Yii::t('app','status_active').'\" src=\"'.Yii::app()->getRequest()->baseUrl.'/images/icons/tick.png\" /></span>"',
          ),
        array(
            "name"=>'cp_code',
            "value"=>'ASystemUser::getCpNameByCpCode($data->cp_code)',
        ),
        array(
            "name"=>'channel_code',
            "type"=>'raw',
            "value"=>'implode(", ",unserialize($data->channel_code))',
        ),
        'created_date',
        'lastest_login',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

<?php echo $this->renderPartial('_permission', array('arrayDataProvider'=>$arrayDataProvider,'id'=>$model->id)); ?>


