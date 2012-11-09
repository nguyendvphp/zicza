<?php
$this->breadcrumbs=array(
	'Wuser Items'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List WUserItem', 'url'=>array('index')),
	array('label'=>'Create WUserItem', 'url'=>array('create')),
	array('label'=>'Update WUserItem', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete WUserItem', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage WUserItem', 'url'=>array('admin')),
);
?>

<h1>View WUserItem #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'title',
		'description',
		'image',
		'status',
		'created_date',
		'latest_update',
	),
)); ?>
