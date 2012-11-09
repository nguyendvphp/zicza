<?php
$this->breadcrumbs=array(
	'Amenus'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AMenu', 'url'=>array('index')),
	array('label'=>'Manage AMenu', 'url'=>array('admin')),
);
?>

<h1>Create AMenu</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>