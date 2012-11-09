 <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/system_user.js');?>
<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'system-user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Yii::t('adm/app','field_required');?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php 
            if(isset($model->username)){
                echo $form->textField($model,'username',array('size'=>50,'maxlength'=>50,'disabled'=>'disabled','style'=>'font-weight:bold')); 
            }else{
                echo $form->textField($model,'username',array('size'=>50,'maxlength'=>50));
            }
        ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php 
            if(isset($model->username)){
                echo "<input type='button' name='changepass' onclick='openDialogUser(\"".$model->id."\");' value='".Yii::t('adm/user','change_password')."' />";
            }else{
                 echo $form->passwordField($model,'password',array('size'=>50,'maxlength'=>255)); 
            }
        ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50)); ?>
        <span class="note"><?php echo Yii::t('adm/app','format_email');?></span>
		<?php echo $form->error($model,'email'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'phonenumber'); ?>
		<?php echo $form->textField($model,'phonenumber',array('size'=>50,'maxlength'=>50)); ?>
        <span class="note"><?php echo Yii::t('adm/app','format_phonnumber');?></span>
		<?php echo $form->error($model,'phonenumber'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php //echo $form->textField($model,'status'); ?>
        <?php //echo $form->dropDownList($model,'status',Lookup::items('UserStatus'),array('prompt' => '(Chọn...)')); ?>
        <?php echo $form->checkbox($model, 'status'); ?>
        <span class="note">Tick sẽ kích hoạt</span>
		<?php echo $form->error($model,'status'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'group_id'); ?>
		<?php //echo $form->textField($model,'group_id'); ?>
        <?php echo $form->dropDownList($model,'group_id', CHtml::listData(SystemGroup::model()->findAll(),"id","group_title")); ?>
		<?php echo $form->error($model,'group_id'); ?>
	</div>
    
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('adm/app','create') : Yii::t('adm/app','save'), array('class' => 'button orange')); ?>
        <?php echo CHtml::submitButton(Yii::t('adm/app','cancel'), array('submit' => $this->createUrl('admin'), 'class' => 'button orange')); ?>
	</div>

<?php $this->endWidget(); ?>
<div id="change_password" title="<?php echo Yii::t('adm/user','change_password'); ?>">
    <label><?php echo Yii::t('adm/user','new_password'); ?></label>
    <input type="password" name="" value="" id="newpass" />
    <br />
    <br />
    <label><?php echo Yii::t('adm/user','re_new_password'); ?></label>
    <input type="password" name="" value="" id="renewpass" />
    <br />
    <br />
    <?php 
        if(isset($model->id)){ ?>
            <input type="button" value="<?php echo Yii::t('adm/user','save'); ?>" onclick="ChangePassword('<?php echo $model->id; ?>');" />
        <?php }
    ?>
</div>

</div><!-- form -->