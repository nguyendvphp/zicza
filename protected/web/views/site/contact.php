<?php
$this->pageTitle=Yii::app()->name .' - '.Yii::t('web/home','contactus');
$this->breadcrumbs=array(
	Yii::t('web/home','contactus'),
);
?>
<div class="contact">

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<div class="form wide">

<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
));
 ?>

	<p class="note"><?php //echo Yii::t('web/home','note');?>.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->textFieldRow($model,'name',array('size'=>40,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->textFieldRow($model,'email',array('size'=>40,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->textFieldRow($model,'subject',array('size'=>40,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->textAreaRow($model,'body',array('rows'=>6, 'cols'=>30)); ?>
	</div>

	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php endif; ?>

	<div class="form-actions">
        <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Submit')); ?>
        <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset', 'icon'=>'remove', 'label'=>'Reset')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>
</div>