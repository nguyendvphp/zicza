<?php
$this->breadcrumbs=array(
	'Wuser Items'=>array('index'),
	$model->title,
);

?>

<h3>Thông tin shop: <?php echo $model->title; ?></h3>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'user_id',
		'title',
		'description',
		'image',
		'status',
		'created_date',
		//'latest_update',
	),
)); ?>
