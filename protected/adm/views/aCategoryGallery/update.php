<?php
$this->breadcrumbs=array(
	Yii::t('adm/gallery','categallery')=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('adm/gallery','u_categallery'),
);

$this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'items'=>array(
        array('label'=>Yii::t('adm/gallery','cr_categallery'), 'url'=>array('create'), 'active'=>true),
        array('label'=>Yii::t('adm/gallery','v_categallery'), 'url'=>array('view', 'id'=>$model->id)),
        array('label'=>Yii::t('adm/gallery','categallery'), 'url'=>array('admin')),
    ),
));

?>
<h3><?php echo Yii::t('adm/gallery','u_categallery');?> <?php echo $model->category_title; ?></h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>