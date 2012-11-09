<?php
$this->breadcrumbs=array(
	Yii::t('adm/news','manage_news')=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('adm/app','create_sysuser'), 'url'=>array('create'),'linkOptions'=>array('class'=>'link-new')),
	array('label'=>Yii::t('adm/app','update_sysuser'), 'url'=>array('update', 'id'=>$model->id),'linkOptions'=>array('class'=>'link-edit')),
	array('label'=>Yii::t('adm/app','delete_sysuser'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('adm/app','confirm'),'class'=>'link-delete')),
	array('label'=>Yii::t('adm/app','icon_sysuser'), 'url'=>array('admin'),'linkOptions'=>array('class'=>'link-manageuser')),
);
?>

<h3><?php echo Yii::t('adm/news','view_news');?> <?php echo $model->news_title; ?></h3>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'news_category_id',
		'news_title',
		'news_short_description:html',
		'news_detail:html',
		'status',
		'priority',
		'created_time',
		'created_by',
		'updated_time',
		'updated_by',
		array(
            "name"=>'image_id',
            'type'=>'html',
            "value"=>AImages::getImageById($model->image_id),
        ),
	),
)); ?>
