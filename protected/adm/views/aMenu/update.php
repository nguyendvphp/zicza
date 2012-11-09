<?php
$this->breadcrumbs=array(
	'Amenus'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AMenu', 'url'=>array('index')),
	array('label'=>'Create AMenu', 'url'=>array('create')),
	array('label'=>'View AMenu', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AMenu', 'url'=>array('admin')),
);
?>

<h1>Update AMenu <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>