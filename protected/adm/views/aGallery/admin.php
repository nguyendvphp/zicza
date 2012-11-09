<?php
$this->breadcrumbs=array(
	Yii::t('adm/gallery','mnu_gallery'),
);

$this->menu=array(
	array('label'=>Yii::t('adm/gallery','cr_categallery'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('agallery-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3><?php echo Yii::t('adm/gallery','mnu_gallery')?></h3>

<?php echo CHtml::link('Tìm kiếm nâng cao','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'agallery-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'gallery_title',
		//'gallery_description',
		'gallery_price',
		'gallery_number',
		'gallery_size_album',
		/*
		'gallery_time_trans',
		'gallery_is_slideshow',
		'gallery_shirt_married',
		'gallery_time_photo',
		'gallery_uniform',
		'gallery_status',
		'gallery_cate_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
