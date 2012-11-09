<?php
$this->breadcrumbs=array(
	'Amenu Types'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AMenuTypes', 'url'=>array('index')),
	array('label'=>'Create AMenuTypes', 'url'=>array('create')),
	array('label'=>'View AMenuTypes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AMenuTypes', 'url'=>array('admin')),
);
?>

<h1>Update AMenuTypes <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>