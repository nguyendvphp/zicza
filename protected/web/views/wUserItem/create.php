<?php
$this->breadcrumbs=array(
	'Wuser Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List WUserItem', 'url'=>array('index')),
	array('label'=>'Manage WUserItem', 'url'=>array('admin')),
);
?>

<h1>Create WUserItem</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>