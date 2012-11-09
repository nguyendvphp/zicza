<?php
$this->breadcrumbs=array(
	Yii::t('adm/news','manage_cate')=>array('admin'),
	Yii::t('adm/news','create_cate')
);

$this->menu=array(
	array('label'=>Yii::t('adm/news','adm_cate'), 'url'=>array('admin'),'linkOptions'=>array('class'=>'link-manageuser')),
);
?>

<h3><?php echo Yii::t('adm/news','create_cate');?></h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>