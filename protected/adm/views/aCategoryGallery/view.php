<?php
$this->breadcrumbs=array(
	Yii::t('adm/gallery','categallery')=>array('admin'),
	$model->category_title,
);

$this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'items'=>array(
        array('label'=>Yii::t('adm/gallery','cr_categallery'), 'url'=>array('create'), 'active'=>true),
        array('label'=>Yii::t('adm/gallery','u_categallery'), 'url'=>array('view', 'id'=>$model->id)),
        array('label'=>Yii::t('adm/gallery','d_categallery'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
        array('label'=>Yii::t('adm/gallery','categallery'), 'url'=>array('admin')),
    ),
));
?>

<h3><?php echo Yii::t('adm/gallery','v_categallery')?> # <?php echo $model->category_title; ?></h3>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'category_title',
		'category_description',
		'thumbnail',
		'created_time',
		'status',
	),
)); ?>
