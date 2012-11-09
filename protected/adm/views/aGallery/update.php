<?php
$this->breadcrumbs=array(
	'Agalleries'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AGallery', 'url'=>array('index')),
	array('label'=>'Create AGallery', 'url'=>array('create')),
	array('label'=>'View AGallery', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AGallery', 'url'=>array('admin')),
);
?>

<h1>Update AGallery <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>