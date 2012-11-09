<?php
$this->breadcrumbs=array(
	'W Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List wUsers', 'url'=>array('index')),
	array('label'=>'Create wUsers', 'url'=>array('create')),
	array('label'=>'View wUsers', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage wUsers', 'url'=>array('admin')),
);
?>

<h1>Update wUsers <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>