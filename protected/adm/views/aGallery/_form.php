<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'agallery-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'gallery_title'); ?>
		<?php echo $form->textField($model,'gallery_title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'gallery_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gallery_description'); ?>
		<?php echo $form->textArea($model,'gallery_description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'gallery_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gallery_price'); ?>
		<?php echo $form->textField($model,'gallery_price'); ?>
		<?php echo $form->error($model,'gallery_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gallery_number'); ?>
		<?php echo $form->textField($model,'gallery_number'); ?>
		<?php echo $form->error($model,'gallery_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gallery_size_album'); ?>
		<?php echo $form->textField($model,'gallery_size_album',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'gallery_size_album'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gallery_time_trans'); ?>
		<?php echo $form->textField($model,'gallery_time_trans'); ?>
		<?php echo $form->error($model,'gallery_time_trans'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gallery_is_slideshow'); ?>
		<?php echo $form->textField($model,'gallery_is_slideshow'); ?>
		<?php echo $form->error($model,'gallery_is_slideshow'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gallery_shirt_married'); ?>
		<?php echo $form->textField($model,'gallery_shirt_married'); ?>
		<?php echo $form->error($model,'gallery_shirt_married'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gallery_time_photo'); ?>
		<?php echo $form->textField($model,'gallery_time_photo'); ?>
		<?php echo $form->error($model,'gallery_time_photo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gallery_uniform'); ?>
		<?php echo $form->textArea($model,'gallery_uniform',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'gallery_uniform'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gallery_status'); ?>
		<?php echo $form->textField($model,'gallery_status'); ?>
		<?php echo $form->error($model,'gallery_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gallery_cate_id'); ?>
		<?php echo $form->textField($model,'gallery_cate_id'); ?>
		<?php echo $form->error($model,'gallery_cate_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->