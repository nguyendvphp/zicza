<?php
$this->breadcrumbs=array(
	'Agalleries'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List AGallery', 'url'=>array('index')),
	array('label'=>'Create AGallery', 'url'=>array('create')),
	array('label'=>'Update AGallery', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete AGallery', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AGallery', 'url'=>array('admin')),
);
?>

<h1>View AGallery #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'gallery_title',
		'gallery_description',
		'gallery_price',
		'gallery_number',
		'gallery_size_album',
		'gallery_time_trans',
		'gallery_is_slideshow',
		'gallery_shirt_married',
		'gallery_time_photo',
		'gallery_uniform',
		'gallery_status',
		'gallery_cate_id',
	),
)); ?>
