<?php
$this->breadcrumbs=array(
	'Anews Categories',
);

$this->menu=array(
	array('label'=>'Create ANewsCategories', 'url'=>array('create')),
	array('label'=>'Manage ANewsCategories', 'url'=>array('admin')),
);
?>

<h1>Anews Categories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
