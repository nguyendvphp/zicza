<?php
$this->breadcrumbs=array(
	'Anews'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ANews', 'url'=>array('index')),
	array('label'=>'Create ANews', 'url'=>array('create')),
	array('label'=>'View ANews', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ANews', 'url'=>array('admin')),
);
?>

<h1>Update ANews <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>