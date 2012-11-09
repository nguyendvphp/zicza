<?php
$this->breadcrumbs=array(
	Yii::t('adm/gallery','categallery')=>array('admin'),
	Yii::t('adm/gallery','cr_categallery'),
);

$this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'items'=>array(
        array('label'=>Yii::t('adm/gallery','categallery'), 'url'=>array('admin'), 'active'=>true),
    ),
));
?>

<h3><?php echo Yii::t('adm/gallery','cr_categallery');?></h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>