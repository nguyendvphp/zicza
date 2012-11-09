<?php
$this->breadcrumbs=array(
	'Acategory Galleries',
);

$this->menu=array(
	array('label'=>'Create ACategoryGallery', 'url'=>array('create')),
	array('label'=>'Manage ACategoryGallery', 'url'=>array('admin')),
);
?>

<h1>Acategory Galleries</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
