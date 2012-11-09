<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'anews-categories-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Yii::t('adm/app','field_required');?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'category_title'); ?>
		<?php echo $form->textField($model,'category_title',array('size'=>40,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'category_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'category_description'); ?>
		<?php echo $form->textArea($model,'category_description',array('rows'=>4, 'cols'=>30)); ?>
		<?php echo $form->error($model,'category_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',array(0 => Yii::t('adm/app','disable'),1=>Yii::t('adm/app','Enable')),array('prompt' => '(Chọn...)')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'priority'); ?>
		<?php echo $form->textField($model,'priority',array('size'=>40)); ?>
		<?php echo $form->error($model,'priority'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('adm/app','create') : Yii::t('adm/app','save'), array('class' => 'button orange')); ?>
        <?php echo CHtml::submitButton(Yii::t('adm/app','cancel'), array('submit' => $this->createUrl('admin'), 'class' => 'button orange')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->