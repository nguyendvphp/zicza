<?php
$this->breadcrumbs=array(
	'Wuser Items',
);

$this->menu=array(
	array('label'=>'Create WUserItem', 'url'=>array('create')),
	array('label'=>'Manage WUserItem', 'url'=>array('admin')),
);
?>

<h1>Wuser Items</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
