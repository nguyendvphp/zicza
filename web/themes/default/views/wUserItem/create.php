<?php
$this->breadcrumbs=array(
	'Wuser Items'=>array('index'),
	'Create',
);
?>

<h3>Doanh nghiệp tạo shop mới</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>