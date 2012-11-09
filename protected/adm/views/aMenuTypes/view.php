<?php
$this->breadcrumbs=array(
	'Amenu Types'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List AMenuTypes', 'url'=>array('index')),
	array('label'=>'Create AMenuTypes', 'url'=>array('create')),
	array('label'=>'Update AMenuTypes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete AMenuTypes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AMenuTypes', 'url'=>array('admin')),
);
?>

<h1>View AMenuTypes #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'menutype',
		'title',
		'description',
	),
)); ?>
