<?php
$this->breadcrumbs=array(
	'Anews Categories'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ANewsCategories', 'url'=>array('index')),
	array('label'=>'Create ANewsCategories', 'url'=>array('create')),
	array('label'=>'Update ANewsCategories', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ANewsCategories', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ANewsCategories', 'url'=>array('admin')),
);
?>

<h1>View ANewsCategories #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'category_title',
		'category_description',
		'status',
		'priority',
	),
)); ?>
