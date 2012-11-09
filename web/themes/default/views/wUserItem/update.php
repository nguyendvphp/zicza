<?php
$this->breadcrumbs=array(
	'Wuser Items'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List WUserItem', 'url'=>array('index')),
	array('label'=>'Create WUserItem', 'url'=>array('create')),
	array('label'=>'View WUserItem', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage WUserItem', 'url'=>array('admin')),
);
?>

<h1>Update WUserItem <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>