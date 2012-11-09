<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gallery_title'); ?>
		<?php echo $form->textField($model,'gallery_title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gallery_description'); ?>
		<?php echo $form->textArea($model,'gallery_description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gallery_price'); ?>
		<?php echo $form->textField($model,'gallery_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gallery_number'); ?>
		<?php echo $form->textField($model,'gallery_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gallery_size_album'); ?>
		<?php echo $form->textField($model,'gallery_size_album',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gallery_time_trans'); ?>
		<?php echo $form->textField($model,'gallery_time_trans'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gallery_is_slideshow'); ?>
		<?php echo $form->textField($model,'gallery_is_slideshow'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gallery_shirt_married'); ?>
		<?php echo $form->textField($model,'gallery_shirt_married'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gallery_time_photo'); ?>
		<?php echo $form->textField($model,'gallery_time_photo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gallery_uniform'); ?>
		<?php echo $form->textArea($model,'gallery_uniform',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gallery_status'); ?>
		<?php echo $form->textField($model,'gallery_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gallery_cate_id'); ?>
		<?php echo $form->textField($model,'gallery_cate_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->