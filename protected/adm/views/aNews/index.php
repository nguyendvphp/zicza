<?php
$this->breadcrumbs=array(
	'Anews',
);

$this->menu=array(
	array('label'=>'Create ANews', 'url'=>array('create')),
	array('label'=>'Manage ANews', 'url'=>array('admin')),
);
?>

<h1>Anews</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
