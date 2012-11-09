<?php
$this->breadcrumbs=array(
	'W Users',
);

$this->menu=array(
	array('label'=>'Create wUsers', 'url'=>array('create')),
	array('label'=>'Manage wUsers', 'url'=>array('admin')),
);
?>

<h1>W Users</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
