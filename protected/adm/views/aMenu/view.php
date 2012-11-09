<?php
$this->breadcrumbs=array(
	'Amenus'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List AMenu', 'url'=>array('index')),
	array('label'=>'Create AMenu', 'url'=>array('create')),
	array('label'=>'Update AMenu', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete AMenu', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AMenu', 'url'=>array('admin')),
);
?>

<h1>View AMenu #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'menutype',
		'title',
		'alias',
		'path',
		'link',
		'published',
		'parent_id',
		'level',
		'type',
	),
)); ?>
