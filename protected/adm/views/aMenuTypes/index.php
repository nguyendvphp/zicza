<?php
$this->breadcrumbs=array(
	'Amenu Types',
);

$this->menu=array(
	array('label'=>'Create AMenuTypes', 'url'=>array('create')),
	array('label'=>'Manage AMenuTypes', 'url'=>array('admin')),
);
?>

<h1>Amenu Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
