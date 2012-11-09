<?php
$this->breadcrumbs=array(
	'Amenu Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AMenuTypes', 'url'=>array('index')),
	array('label'=>'Manage AMenuTypes', 'url'=>array('admin')),
);
?>

<h1>Create AMenuTypes</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>