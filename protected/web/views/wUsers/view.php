<?php
$this->breadcrumbs=array(
	'W Users'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List wUsers', 'url'=>array('index')),
	array('label'=>'Create wUsers', 'url'=>array('create')),
	array('label'=>'Update wUsers', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete wUsers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage wUsers', 'url'=>array('admin')),
);
?>

<h1>View wUsers #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'password',
		'email',
		'fullname',
		'birthday',
		'company',
		'url',
		'phone',
		'mobile',
		'address',
		'group',
		'created_by',
		'created_date',
		'last_login',
		'active_key',
		'status',
	),
)); ?>
