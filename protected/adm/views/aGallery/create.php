<?php
$this->breadcrumbs=array(
	'Agalleries'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AGallery', 'url'=>array('index')),
	array('label'=>'Manage AGallery', 'url'=>array('admin')),
);
?>

<h1>Create AGallery</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>